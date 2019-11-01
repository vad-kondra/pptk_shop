<?php


namespace app\services;


use app\models\AboutContentForm;
use app\models\Config;
use app\models\TermsContentForm;
use app\modules\admin\models\FooterContentForm;
use app\modules\admin\models\HeaderContentForm;
use app\modules\admin\models\MainContentForm;
use app\modules\admin\models\ModelHeader;
use yii\web\ForbiddenHttpException;

class ContentManageService
{

    public function updateMain(MainContentForm $main)
    {

        Config::setValue(Config::MAIN_TITLE, $main->main_title);
        Config::setValue(Config::MAIN_SHORT_TITLE, $main->main_short_title);
        Config::setValue(Config::MAIN_PHONE_1, $main->main_phone_1);
        Config::setValue(Config::MAIN_PHONE_2, $main->main_phone_2);
        Config::setValue(Config::MAIN_EMAIL, $main->main_email);
        Config::setValue(Config::MAIN_ADDRESS, $main->main_address);
        Config::setValue(Config::TIME_WORK, $main->time_work);

    }

    public function updateHeader(HeaderContentForm $header)
    {

    }

    public function updateFooter(FooterContentForm $footer)
    {

    }

    public function getMain()
    {
        $main = new MainContentForm();
        try {
            $main->main_title = Config::getValue(Config::MAIN_TITLE);
            $main->main_short_title = Config::getValue(Config::MAIN_SHORT_TITLE);
            $main->main_phone_1 = Config::getValue(Config::MAIN_PHONE_1);
            $main->main_phone_2 = Config::getValue(Config::MAIN_PHONE_2);
            $main->main_email = Config::getValue(Config::MAIN_EMAIL);
            $main->main_address = Config::getValue(Config::MAIN_ADDRESS);
            $main->main_address = Config::getValue(Config::MAIN_ADDRESS);
            $main->time_work = Config::getValue(Config::TIME_WORK);
        } catch (ForbiddenHttpException $e) {
        }
        return $main;
    }

    public function getHeader()
    {
        $header = new HeaderContentForm();
        return $header;
    }

    public function getFooter()
    {
        $footer = new FooterContentForm();
        return $footer;
    }

    public function getAbout()
    {
        $about = new AboutContentForm();
        try {
            $about->about_text = Config::getValue(Config::ABOUT_TEXT);
        } catch (ForbiddenHttpException $e) {
        }
        return $about;
    }

    public function updateAbout(AboutContentForm $about)
    {
        Config::setValue(Config::ABOUT_TEXT, $about->about_text);
    }

    public function getTerms()
    {
        $terms = new TermsContentForm();
        try {
            $terms->terms_text = Config::getValue(Config::PRIVATE_POLICY_TEXT);
        } catch (ForbiddenHttpException $e) {
        }
        return $terms;
    }


    public function updateTerms(TermsContentForm $terms)
    {
        Config::setValue(Config::PRIVATE_POLICY_TEXT, $terms->terms_text);
    }

}