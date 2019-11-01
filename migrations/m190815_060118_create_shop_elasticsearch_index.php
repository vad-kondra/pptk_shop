<?php

use Elasticsearch\Client;
use Elasticsearch\Common\Exceptions\Missing404Exception;
use yii\db\Migration;

/**
 * Class m190815_060118_create_shop_elasticsearch_index
 */



class m190815_060118_create_shop_elasticsearch_index extends Migration
{

		private function getClient(): Client
		{
				return Yii::$container->get(Client::class);
		}

    /**
     * {@inheritdoc}
     */
    public function up()
    {
				$client = $this->getClient();

				try {
						$client->indices()->delete([
							'index' => 'shop'
						]);
				} catch (Missing404Exception $e) {

				}

				$params = [
					'index' => 'shop',
					'body' => [
						'mappings' => [
							'_source' => [
								'enabled' => true,
							],
							'properties' => [
								'id' => [
									'type' => 'integer',
								],
								'name' => [
									'type' => 'text',
								],
								'art' => [
									'type' => 'text',
								],
								'description' => [
									'type' => 'text',
								],
								'price' => [
									'type' => 'integer',
								],
								'brand' => [
									'type' => 'integer',
								],
								'categories' => [
									'type' => 'integer',
								],
								'tags' => [
									'type' => 'integer',
								],
								'values' => [
									'type' => 'nested',
									'properties' => [
										'characteristic' => [
											'type' => 'integer'
										],
										'value_string' => [
											'type' => 'keyword',
										],
										'value_int' => [
											'type' => 'integer',
										],
									]
								]
							]
						]
					]
				];

				$client->indices()->create($params);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
				try {
						$this->getClient()->indices()->delete([
							'index' => 'shop'
						]);
				} catch (Missing404Exception $e) {}
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190815_060118_create_shop_elasticsearch_index cannot be reverted.\n";

        return false;
    }
    */
}
