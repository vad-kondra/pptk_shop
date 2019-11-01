<?php


namespace app\modules\admin\controllers\search;

use app\models\Product;
use app\models\Value;
use Elasticsearch\Client;
use Elasticsearch\Common\Exceptions\Missing404Exception;
use yii\console\Controller;
use yii\helpers\ArrayHelper;

class SearchController extends Controller
{
    private $client;

    public function __construct($id, $module, Client $client, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->client = $client;
    }

    public function actionReindex(): void
    {
        $query = Product::find()
            ->active()
            ->with(['category', 'tagAssignments', 'values'])
            ->orderBy('id');

        $this->stdout('Clearing' . PHP_EOL);

        try{
                $this->client->indices()->delete(['index' => 'shop']);
        } catch (Missing404Exception $e) {
                $this->stdout('Index is empty' . PHP_EOL);
        }

        $this->stdout('Indexing of products' . PHP_EOL);

        foreach ($query->each() as $product) {
            /** @var Product $product */
            $this->stdout('Product #' . $product->id . PHP_EOL);
            $this->client->index([
                'index' => 'shop',
                'type' => 'products',
                'id' => $product->id,
                'body' => [
                    'name' => $product->name,
                    'description' => strip_tags($product->description),
                    'price' => (int)$product->price_new,
                    'brand' => (int)$product->brand_id,
                    'categories' => ArrayHelper::merge([
                            $product->category_id
                    ], ArrayHelper::getColumn($product->categoryAssignments, 'category_id')
                    ),
                    'values' => ArrayHelper::map(
                        $product->values,
                        function (Value $value) { return 'attr_' . $value->characteristic_id; },
                        function (Value $value) {
                            return [
                                    'value_string' => (string)$value->value,
                                    'value_int' => (int)$value->value,
                            ];
                        }
                    ),
                ]
            ]);
        }

        $this->stdout('Done!' . PHP_EOL);
    }
}