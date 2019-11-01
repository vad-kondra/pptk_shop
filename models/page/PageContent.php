<?php

namespace app\models\page;
use Yii;
use yii\caching\TagDependency;
use yii\web\ForbiddenHttpException;

/**
 * This is the model class for table "page_content".
 *
 * @property int $id
 * @property string $page
 * @property string $key_v
 * @property string $value
 * @property string $lang
 */
class PageContent extends \yii\db\ActiveRecord
{

    const CHANGE_STATIC_PAGE_PERMISSION = 'changeStaticPage';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'page_content';
    }

    private static function getLanguages()
    {
        return ['ru','uk'];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['page', 'key_v', 'value', 'lang'], 'required'],
            [['value'], 'string'],
            [['page', 'key_v'], 'string', 'max' => 255],
            [['lang'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page' => 'Page',
            'key_v' => 'Key V',
            'value' => 'Value',
            'lang' => 'Lang',
        ];
    }


    public static function setValue($page,$key,$val,$options = ["lang"=>"ru"]){
        $lang = $options["lang"];
        if(!in_array($lang,self::getLanguages()))
            throw new ForbiddenHttpException(t_app('Такой язык не поддерживается'). "\"".$lang."\"");

        PageContent::deleteAll(["key_v"=>$key,"page"=>$page,"lang"=>$lang]);
        $val = trim($val);
        if( !empty($val)) {
            $content = new PageContent();
            $content->key_v = $key;
            $content->value = $val;
            $content->page = $page;
            $content->lang = $lang;
            $content->save();
            TagDependency::invalidate(Yii::$app->getCache(), ['tags'=>'cache_page_content'] );
        }
    }

    public static function getValue($page,$key,$options = ["lang"=>"ru"]){
        $lang = $options["lang"];
        if(!in_array($lang,self::getLanguages()))
            throw new ForbiddenHttpException("Не поддерживаемый язык '$lang'");

        $val  = PageContent::find()->where(["key_v"=>$key,"page"=>$page,"lang"=>$lang])->cache(0,new TagDependency(['tags'=>'cache_page_content']))->all();//кешируем
        if(count($val) == 0) {
            $val = PageContent::find()->where(["key_v"=>$key,"page"=>$page])->cache(0,new TagDependency(['tags'=>'cache_page_content']))->limit(1)->all();
        }
        if(count($val) == 0) {
            $val = "";
        }
        else {
            $val = $val[0]->value;
        }
        return $val;
    }



    public static function getCommonStyleClasses(){
        return  [
            'Контейнер' => [
                'class' => 'container',
                'tags'  => ['p', 'h2', 'h1','td','th', 'img', 'table']
            ],
            'Выделено' => [
                'class' => 'highlighted',
                'tags'  => ['p', 'h2', 'h1','td','th']
            ],
            'Внутренний отступ 10px' => [
                'class' => 'ct_p_10',
                'tags'  => ['p', 'h2', 'h1','td','th']
            ],
            'Внутренний отступ 20px' => [
                'class' => 'ct_p_20',
                'tags'  => ['p', 'h2', 'h1','td','th']
            ],
            'Внутренний отступ 40px' => [
                'class' => 'ct_p_40',
                'tags'  => ['p', 'h2', 'h1','td','th']
            ],
            'Внешний отступ 10px' => [
                'class' => 'ct_m_10',
                'tags'  => ['p', 'h2', 'h1','td','th']
            ],
            'Внешний отступ 20px' => [
                'class' => 'ct_m_20',
                'tags'  => ['p', 'h2', 'h1','td','th']
            ],
            'Внешний отступ 40px' => [
                'class' => 'ct_m_40',
                'tags'  => ['p', 'h2', 'h1','td','th']
            ],
            'Внешний отступ сверху 20px' => [
                'class' => 'mt-20',
                'tags'  => ['p', 'h2', 'h1','td','th', 'img']
            ],
            'Внешний отступ снизу 20px' => [
                'class' => 'mb-20',
                'tags'  => ['p', 'h2', 'h1','td','th', 'img']
            ],
            'Внешний отступ сверху 45px' => [
                'class' => 'mt-5',
                'tags'  => ['p', 'h2', 'h1','td','th', 'img']
            ],
            'Внешний отступ снизу 45px' => [
                'class' => 'mb-5',
                'tags'  => ['p', 'h2', 'h1','td','th', 'img']
            ],
            'Отступ слева 20px' => [
                'class' => 'ct-ml-20',
                'tags'  => ['p', 'h2', 'h1','td','th', 'img']
            ],
            'Отступ справа 20px' => [
                'class' => 'ct-mr-20',
                'tags'  => ['p', 'h2', 'h1','td','th', 'img']
            ],
            'Отступ слева 40px' => [
                'class' => 'ct-ml-40',
                'tags'  => ['p', 'h2', 'h1','td','th', 'img']
            ],
            'Отступ справа 40px' => [
                'class' => 'ct-mr-40',
                'tags'  => ['p', 'h2', 'h1','td','th', 'img']
            ],
            'В линию' => [
                'class' => 'inline',
                'tags'  => ['p', 'h2', 'h1','td','th', 'img', 'table']
            ],
            'Высота строки 20px' => [
                'class' => 'ct_lh_20',
                'tags'  => ['p', 'h2', 'h1','td','th']
            ],
            'Высота строки 30px' => [
                'class' => 'ct_lh_30',
                'tags'  => ['p', 'h2', 'h1','td','th']
            ],
            'Высота строки 40px' => [
                'class' => 'ct_lh_40',
                'tags'  => ['p', 'h2', 'h1','td','th']
            ],
            'Высота строки 50px' => [
                'class' => 'ct_lh_50',
                'tags'  => ['p', 'h2', 'h1','td','th']
            ],
            'Таблица по центру' => [
                'class' => 'ct_t_center',
                'tags'  => ['table']
            ],
            'Выравнивание по левому краю' => [
                'class' => 'ct_img_left',
                'tags'  => ['img']
            ],
            'Выравнивание по центру' => [
                'class' => 'ct_img_center',
                'tags'  => ['img']
            ],
            'Выравнивание по правому краю' => [
                'class' => 'ct_img_right',
                'tags'  => ['img']
            ],

            'Шрифт 6px' => [
                'class' => 'fz-6',
                'tags'  => ['p', 'h2', 'h1','td','th']
            ],
            'Шрифт 10px' => [
                'class' => 'fz-10',
                'tags'  => ['p', 'h2', 'h1','td','th']
            ],
            'Шрифт 12px' => [
                'class' => 'fz-12',
                'tags'  => ['p', 'h2', 'h1','td','th']
            ],
            'Шрифт 14px' => [
                'class' => 'fz-14',
                'tags'  => ['p', 'h2', 'h1','td','th']
            ],
            'Шрифт 18px' => [
                'class' => 'fz-18',
                'tags'  => ['p', 'h2', 'h1','td','th']
            ],
            'Шрифт 20px' => [
                'class' => 'fz-20',
                'tags'  => ['p', 'h2', 'h1','td','th']
            ],
            'Шрифт 26px' => [
                'class' => 'fz-26',
                'tags'  => ['p', 'h2', 'h1','td','th']
            ],
            'Шрифт Quicksand' => [
                'class' => 'ff-quicksand',
                'tags'  => ['p', 'h2', 'h1','td','th']
            ],
            'Шрифт Verdana' => [
                'class' => 'ff-verdana',
                'tags'  => ['p', 'h2', 'h1','td','th']
            ],
            'Шрифт Times New Roman' => [
                'class' => 'ff-times-new-roman',
                'tags'  => ['p', 'h2', 'h1','td','th']
            ],
            'Шрифт Times Georgia' => [
                'class' => 'ff-georgia',
                'tags'  => ['p', 'h2', 'h1','td','th']
            ],
            'Ширина 100%' => [
                'class' => 'ct-w-100',
                'tags'  => ['p', 'h2', 'h1','td','th','table', 'img']
            ],

        ];
    }
}
