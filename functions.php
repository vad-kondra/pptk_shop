<?php


use app\models\Config;
use yii\web\ForbiddenHttpException;

function debug($s, $isClean =true){
    if($isClean)
        ob_clean();
    print ("<pre>");
    //echo var_dump($s);
		print_r($s);
		print ("</pre>");

    die();
}

/**
 * @param $type (required, email, unique_email, sub_unique_email, pattern_phone, pattern_domain, compare_password, tooLong)
 * @return mixed
 */
function getRuleMessage($type){
    $messages = [
        'required' => 'Необходимо заполнить это поле',
        'email' => 'Неверный формат эл. почты',
        'unique_email' => 'Пользователь с таким эл. адресом уже существует',
        'unique_phone' => 'Пользователь с таким моб. телефоном уже существует',
        'unique_username' => 'Пользователь с таким логином уже существует',
        'sub_unique_email' => 'Вы уже подписаны',
        'pattern_phone' => 'Неверный формат моб. телефона',
        'compare_password' => 'Пароли не совпадают',
        'pattern_domain' => 'Неверный адрес субдомена',
        'tooLong' => 'Превышена допустимая длина'
    ];
    return $messages[$type];
}

const ALERT_TYPE_ERROR = 'error';
const ALERT_TYPE_DANGER = 'danger';
const ALERT_TYPE_SUCCESS = 'success';
const ALERT_TYPE_INFO = 'info';
const ALERT_TYPE_WARNING = 'warning';

function addAlert($type = 'default', $message = ''){
    Yii::$app->session->addFlash('alert', ['message' => $message, 'type' => $type]);
}

function addGrowl($body,$delayFade=1400,$type='success',$closeButton=false,$delayShow=200,$title=false,$icon=false,$showProgressBar=false,$showSeparator=false){
    Yii::$app->session->addFlash('growl', ['body'=>$body,'title'=>$title,'closeButton'=>$closeButton,'type'=>$type,'icon'=>$icon,'delayShow'=>$delayShow,'delayFade'=>$delayFade,'showProgressbar'=>$showProgressBar,'showSeparator'=>$showSeparator]);
}
function showMessage($msg,$type = "success"){
    \Yii::$app->session->addFlash("alert",["message"=>$msg,"type"=>$type]);
}
function returnBack(){
    if(isset($_SERVER['HTTP_REFERER']))
        Yii::$app->response->redirect($_SERVER['HTTP_REFERER']);
    else
        Yii::$app->response->redirect("/admin");
}

/**
 * Сохраняет на сервере файл с уникальным названием полученный при загрузке
 * @param $pathToSave
 * @param $tmpFile
 * @param $name
 * @param array $options
 * @return string
 * @throws ForbiddenHttpException
 */
function saveUniFile($pathToSave, $tmpFile, $name, $options = []){
    $ext = pathinfo($name)["extension"];
    if(isset($options["extension"]) && !in_array($ext,$options["extension"]))
        throw new ForbiddenHttpException("Расширение файла ".$ext." доступные расширения(".implode(",",$options["extension"]).")");

    if(!file_exists($pathToSave))
        throw new ForbiddenHttpException("Не существующая директория ".$pathToSave);
    do {
        $filename = md5(microtime() . rand(0, 9999)) . "." . $ext;
    } while (file_exists($pathToSave . $filename));
    $filepath = $pathToSave . $filename;
    if(!move_uploaded_file($tmpFile, $filepath))
        throw new ForbiddenHttpException("Ошибка перемещения файла '".$tmpFile ."' в '". $filepath."''");
    return $filepath;
}

function db_transliterate($str) {//траслит для уникальных имен в ссылках
    $str = mb_ereg_replace("[^- а-яА-Я0-9a-zA-Z]"," ",$str);

    $str = trim(mb_ereg_replace("[ ]+"," ",$str));
    $str = strtolower(transliterate($str));
    $str = mb_substr($str,0,48);//48- макс длина
    $str = mb_ereg_replace("^-+",'',$str);
    $str = mb_ereg_replace("-+$",'',$str);
    $str = mb_ereg_replace("-{2,}",'-',$str);
    if($str == "")
        $str = "item".time();
    return $str;

}

function generatePassword($length = 8) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $count = mb_strlen($chars);

    for ($i = 0, $result = ''; $i < $length; $i++) {
        $index = rand(0, $count - 1);
        $result .= mb_substr($chars, $index, 1);
    }

    return $result;
}



function transliterate($string) {
    $converter = array(
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => '',    'ы' => 'y',   'ъ' => '',
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

        'А' => 'a',   'Б' => 'b',   'В' => 'v',
        'Г' => 'g',   'Д' => 'd',   'Е' => 'e',
        'Ё' => 'e',   'Ж' => 'zh',  'З' => 'z',
        'И' => 'i',   'Й' => 'y',   'К' => 'k',
        'Л' => 'l',   'М' => 'm',   'Н' => 'n',
        'О' => 'o',   'П' => 'p',   'Р' => 'r',
        'С' => 's',   'Т' => 't',   'У' => 'u',
        'Ф' => 'f',   'Х' => 'h',   'Ц' => 'c',
        'Ч' => 'ch',  'Ш' => 'sh',  'Щ' => 'sch',
        'Ь' => '',    'Ы' => 'y',   'Ъ' => '',
        'Э' => 'e',   'Ю' => 'yu',  'Я' => 'ya',
        ' '=> '-'
    );
    return strtr($string, $converter);
}
/**
 * @param string $content контернт
 * @param string $ext расширение файла
 * @param int $expire время жизни файла
 * @return string путь к файлу
 */
function saveTempFile($content = "",$ext = "png",$expire = 10800,$options = ["type"=>"raw"]){
    if($expire == null || $expire < 0)
        $expire = 10800;
    $cacheTime = time() + $expire;
    if (!file_exists("cache/expire_files/" . $cacheTime))//папки есть?
        mkdir("cache/expire_files/" . $cacheTime);
    $path = getUniName("cache/expire_files/" . $cacheTime . "/", $ext);
    if ($options["type"] == "base64") {
        $bs = preg_split("/,/", $content);
        $content = base64_decode(count($bs)> 1?$bs[1]:$bs[0]);
    }
    file_put_contents($path, $content);
    return $path;
}
function rewriteFile($path,$content = "",$options = ["type"=>"raw"]){
    if (!file_exists($path))
        throw new \yii\web\ForbiddenHttpException("Файл не найден");
    if ($options["type"] == "base64") {
        $bs = preg_split("/,/", $content);
        $content = base64_decode(count($bs)> 1?$bs[1]:$bs[0]);
    }
    file_put_contents($path, $content);
    return $path;
}

function copyUniFile($pathToSave,$current_filepath,$options = []){
    $ext = pathinfo($current_filepath)["extension"];
    if(isset($options["extension"]) && !in_array($ext,$options["extension"]))
        throw new \yii\web\ForbiddenHttpException("Расширение файла ".$ext." доступные расширения(".implode(",",$options["extension"]).")");

    if(!file_exists($pathToSave))
        throw new \yii\web\ForbiddenHttpException("Не существующая директория ".$pathToSave);
    do {
        $filename = md5(microtime() . rand(0, 9999)) . "." . $ext;
    } while (file_exists($pathToSave . $filename));
    $filepath = $pathToSave . $filename;
    if(!copy($current_filepath, $filepath))
        throw new \yii\web\ForbiddenHttpException("Ошибка копирования файла '".$current_filepath ."' в '". $filepath."''");
    return $filepath;
}
function getUniName($dir,$ext){// exm: cache/img/
    do {
        $filename = md5(microtime() . rand(0, 9999)) . "." . $ext;
    } while (file_exists($dir . $filename));
    return $dir . $filename;
}

/**If subject is not passed then header used instead
 * @param $sendTo
 * @param $header
 * @param $content
 * @param null $subject
 * @return bool
 * @throws \yii\base\UserException
 */
function sendMessageEmail($sendTo, $header, $content, $subject = null)
{
    try {
        $subjectStr = !is_null($subject) ? (Yii::$app->name . "|" . $subject) : (Yii::$app->name . "|" . $header);

        $message  = \Yii::$app->mailer->compose( 'email-template', [
            'header' => $header,
            'content' => $content,
        ])
            ->setFrom(Config::getValue(Config::MAIN_EMAIL))
            ->setTo($sendTo)
            ->setSubject($subjectStr);
        //$message->getSwiftMessage()->getHeaders()->addTextHeader('name', 'value');

        return $message->send();
    }catch (Exception $exception){
        //return false;
        throw new \yii\base\UserException("Произошла ошибка при отправке письма! Попробуйте позже.". $exception->getMessage());
    }
}

function sendEmailNew($sendTo, $header, $content, $subject = null)
{
    try {
        $subjectStr = !is_null($subject) ? (Yii::$app->name . "|" . $subject) : (Yii::$app->name . "|" . $header);
        $message  = \Yii::$app->mailer->compose('email-template', [
            'header' => $header,
            'content' => $content,
            'id' => Yii::$app->user->identity->id,
            'auth_key' => Yii::$app->user->identity->auth_key,
            'email' => $sendTo,
        ])
            ->setFrom(Config::getValue(Config::EMAIL_SUPPORT))
            ->setTo($sendTo)
            ->setSubject($subjectStr);
        //$message->getSwiftMessage()->getHeaders()->addTextHeader('name', 'value');
        return $message->send();
    }catch (Exception $exception){
        //return false;
        throw new \yii\base\UserException("Произошла ошибка при отправке письма! Попробуйте позже.". $exception->getMessage());
    }
}

function sendOrderEmail($sendTo, $model, $orderCarts)
{
    try {
        $subjectStr = 'Заказ'." №".$model->number;
        $message  = \Yii::$app->mailer->compose('order-template', [
            'model' => $model,
            'carts' => $orderCarts
        ])
            ->setFrom(Config::getValue(Config::EMAIL_SUPPORT))
            ->setTo($sendTo)
            ->setSubject($subjectStr);
        return $message->send();
    }catch (Exception $exception){}
}

function sendWritingEmail($sendTo, $model)
{
    try {
        $subjectStr = $model->name;
        $message  = \Yii::$app->mailer->compose('letter-template', [
            'model' => $model,
        ])
            ->setFrom(Config::getValue(Config::EMAIL_SUPPORT))
            ->setTo($sendTo)
            ->setSubject($subjectStr);
        return $message->send();
    }catch (Exception $exception){return false;}
}

function showModal($options){
    Yii::$app->session->addFlash("modal",$options);
}
function sendNewsEmail($sendTo, $header, $content, $subject='', $img, $item_uname, $unsub_token){
    try {
        $subjectStr = !empty($subject) ? (Yii::$app->name . "|" . $subject) : (Yii::$app->name . "|" . $header);
        return \Yii::$app->mailer->compose('news-email-template', [
            'header' => $header,
            'content' => $content,
            'img' => $img,
            'item_uname' => $item_uname,
            'unsub_token' => $unsub_token,
        ])
            //->setFrom(\app\models\Config::getValue(\app\models\Config::EMAIL_SUPPORT))
            ->setFrom('emrissol@gmail.com')
            ->setTo($sendTo)
            ->setSubject($subjectStr)
            ->send();
    }catch (\Exception $exception){
        throw new \yii\base\UserException("Произошла ошибка при отправке эл. письма! Попробуйте позже." . ": " . $exception->getMessage());
    }
}
function getDataProviderCountItemHint($dataProvider)
{
    if($dataProvider->getTotalCount()){
        return $dataProvider->getTotalCount();
    }else{
        return 0;
    }
}
function rmRec($path) {
    if (is_file($path)) return unlink($path);
    if (is_dir($path)) {
        foreach(scandir($path) as $p) if (($p!='.') && ($p!='..'))
            rmRec($path.DIRECTORY_SEPARATOR.$p);
        return rmdir($path);
    }
    return false;
}
function getRolesAsAssoc(){
    $roles = Yii::$app->authManager->getRoles();
    unset($roles['guest']);
    //return \yii\helpers\ArrayHelper::map($roles, 'name', 'description');
    $arr = [];
    foreach ($roles as $role){
        $arr[$role->name] = $role->description;
    }
    return $arr;
}
function getCityList(){
    return [0 => "Chongqing", 1 => "Shanghai", 2 => "Delhi", 3 => "Beijing", 4 => "Dhaka", 5 => "Mumbai", 6 => "Lagos", 7 => "Chengdu", 8 => "Karachi", 9 => "Guangzhou", 10 => "Istanbul", 11 => "Tokyo", 12 => "Tianjin", 13 => "Moscow", 14 => "São Paulo", 15 => "Kinshasa", 16 => "Baoding", 17 => "Lahore", 18 => "Cairo", 19 => "Seoul", 20 => "Jakarta", 21 => "Wenzhou", 22 => "Mexico City", 23 => "Lima", 24 => "London", 25 => "Bangkok", 26 => "Xi'an", 27 => "Chennai", 28 => "Bangalore", 29 => "New York City", 30 => "Hyderabad", 31 => "Shenzhen", 32 => "Suzhou", 33 => "Nanjing", 34 => "Dongguan", 35 => "Tehran", 36 => "Quanzhou", 37 => "Shenyang", 38 => "Bogotá", 39 => "Hong Kong", 40 => "Baghdad", 41 => "Fuzhou", 42 => "Changsha", 43 => "Wuhan", 44 => "Hanoi", 45 => "Rio de Janeiro", 46 => "Qingdao", 47 => "Foshan", 48 => "Zunyi", 49 => "Santiago", 50 => "Riyadh", 51 => "Ahmedabad", 52 => "Singapore", 53 => "Shantou", 54 => "Ankara", 55 => "Yangon", 56 => "Saint Petersburg", 57 => "Sydney", 58 => "Casablanca", 59 => "Melbourne", 60 => "Abidjan", 61 => "Alexandria", 62 => "Kolkata", 63 => "Surat", 64 => "Johannesburg", 65 => "Dar es Salaam", 66 => "Shijiazhuang", 67 => "Harbin", 68 => "Giza", 69 => "İzmir", 70 => "Zhengzhou", 71 => "New Taipei City", 72 => "Los Angeles", 73 => "Changchun", 74 => "Cape Town", 75 => "Yokohama", 76 => "Khartoum", 77 => "Guayaquil", 78 => "Hangzhou", 79 => "Xiamen", 80 => "Berlin", 81 => "Busan", 82 => "Ningbo", 83 => "Jeddah", 84 => "Durban", 85 => "Algiers", 86 => "Kabul", 87 => "Hefei", 88 => "Mashhad", 89 => "Pyongyang", 90 => "Madrid", 91 => "Faisalabad", 92 => "Baku", 93 => "Tangshan", 94 => "Ekurhuleni", 95 => "Nairobi", 96 => "Zhongshan", 97 => "Pune", 98 => "Addis Ababa", 99 => "Jaipur", 100 => "Buenos Aires", 101 => "Incheon", 102 => "Quezon City", 103 => "Toronto", 104 => "Kiev", 105 => "Salvador", 106 => "Rome", 107 => "Dubai", 108 => "Luanda", 109 => "Lucknow", 110 => "Kaohsiung", 111 => "Kanpur", 112 => "Chicago", 113 => "Osaka", 114 => "Quito", 115 => "Chaozhou", 116 => "Fortaleza", 117 => "Chittagong", 118 => "Bandung", 119 => "Managua", 120 => "Brasília", 121 => "Belo Horizonte", 122 => "Daegu", 123 => "Houston", 124 => "Douala", 125 => "Medellin", 126 => "Yaoundé", 127 => "Nagpur", 128 => "Cali", 129 => "Tashkent", 130 => "Nagoya", 131 => "Isfahan", 132 => "Phnom Penh", 133 => "Paris", 134 => "Ouagadougou", 135 => "Lanzhou", 136 => "Kano", 137 => "Dalian", 138 => "Guatemala City", 139 => "Havana", 140 => "Rawalpindi", 141 => "Medan", 142 => "Accra", 143 => "Visakhapatnam", 144 => "Gujranwala", 145 => "Jinan", 146 => "Karaj", 147 => "Peshawar", 148 => "Minsk", 149 => "Caracas", 150 => "Sana'a", 151 => "Sapporo", 152 => "Tainan", 153 => "Bucharest", 154 => "Curitiba", 155 => "Shiraz", 156 => "Vienna", 157 => "Brazzaville", 158 => "Bhopal", 159 => "Almaty", 160 => "Hamburg", 161 => "Manila", 162 => "Kuala Lumpur", 163 => "Maputo", 164 => "Budapest", 165 => "Warsaw", 166 => "Lusaka", 167 => "Kathmandu", 168 => "Tabriz", 169 => "Hyderabad", 170 => "Palembang", 171 => "Tijuana", 172 => "Patna", 173 => "Montreal", 174 => "Davao City", 175 => "Harare", 176 => "Barcelona", 177 => "Maracaibo", 178 => "Caloocan", 179 => "Philadelphia", 180 => "Novosibirsk", 181 => "Phoenix", 182 => "Oran", 183 => "Semarang", 184 => "Recife", 185 => "Kobe", 186 => "Daejeon", 187 => "Kampala", 188 => "Kawasaki", 189 => "Guadalajara", 190 => "Auckland", 191 => "Vijayawada", 192 => "Fukuoka", 193 => "Gwangju", 194 => "Porto Alegre", 195 => "Kyoto", 196 => "San Antonio", 197 => "Santa Cruz de la Sierra", 198 => "Munich Germany", 199 => "Kharkiv Ukraine", 200 => "Yekaterinburg", 201 => "San Diego", 202 => "Barranquilla", 203 => "Milan", 204 => "Ibadan", 205 => "Makassar", 206 => "Córdoba", 207 => "Prague", 208 => "Mandalay", 209 => "Dallas", 210 => "Montevideo", 211 => "Qom Iran", 212 => "Ahvaz", 213 => "Sofia", 214 => "Nizhny Novgorod", 215 => "Abuja", 216 => "Calgary", 217 => "Saitama", 218 => "Suwon", 219 => "Hiroshima", 220 => "Rosario", 221 => "Brisbane", 222 => "Allahabad", 223 => "Belgrade", 224 => "Campinas", 225 => "Ulsan", 226 => "Omsk", 227 => "Dakar", 228 => "Abu Dhabi", 229 => "Monterrey", 230 => "Tripoli", 231 => "Rostov-on-Don", 232 => "T'bilisi", 233 => "Fez Morocco", 234 => "Birmingham", 235 => "Yerevan", 236 => "Cologne", 237 => "Tunis", 238 => "Bulawayo", 239 => "Astana", 240 => "Islamabad", 241 => "Cartagena"];
}
function getCountryList(){
    return [0 => "Afghanistan", 1 => "Albania", 2 => "Algeria", 3 => "American Samoa", 4 => "Andorra", 5 => "Angola", 6 => "Anguilla", 7 => "Antarctica", 8 => "Antigua and Barbuda", 9 => "Argentina", 10 => "Armenia", 11 => "Aruba", 12 => "Australia", 13 => "Austria", 14 => "Azerbaijan", 15 => "Bahamas", 16 => "Bahrain", 17 => "Bangladesh", 18 => "Barbados", 19 => "Belarus", 20 => "Belgium", 21 => "Belize", 22 => "Benin", 23 => "Bermuda", 24 => "Bhutan", 25 => "Bolivia", 26 => "Bosnia and Herzegowina", 27 => "Botswana", 28 => "Bouvet Island", 29 => "Brazil", 30 => "British Indian Ocean Territory", 31 => "Brunei Darussalam", 32 => "Bulgaria", 33 => "Burkina Faso", 34 => "Burundi", 35 => "Cambodia", 36 => "Cameroon", 37 => "Canada", 38 => "Cape Verde", 39 => "Cayman Islands", 40 => "Central African Republic", 41 => "Chad", 42 => "Chile", 43 => "China", 44 => "Christmas Island", 45 => "Cocos (Keeling) Islands", 46 => "Colombia", 47 => "Comoros", 48 => "Congo", 49 => "Congo, the Democratic Republic of the", 50 => "Cook Islands", 51 => "Costa Rica", 52 => "Cote d'Ivoire", 53 => "Croatia (Hrvatska)", 54 => "Cuba", 55 => "Cyprus", 56 => "Czech Republic", 57 => "Denmark", 58 => "Djibouti", 59 => "Dominica", 60 => "Dominican Republic", 61 => "East Timor", 62 => "Ecuador", 63 => "Egypt", 64 => "El Salvador", 65 => "Equatorial Guinea", 66 => "Eritrea", 67 => "Estonia", 68 => "Ethiopia", 69 => "Falkland Islands (Malvinas)", 70 => "Faroe Islands", 71 => "Fiji", 72 => "Finland", 73 => "France", 74 => "France Metropolitan", 75 => "French Guiana", 76 => "French Polynesia", 77 => "French Southern Territories", 78 => "Gabon", 79 => "Gambia", 80 => "Georgia", 81 => "Germany", 82 => "Ghana", 83 => "Gibraltar", 84 => "Greece", 85 => "Greenland", 86 => "Grenada", 87 => "Guadeloupe", 88 => "Guam", 89 => "Guatemala", 90 => "Guinea", 91 => "Guinea-Bissau", 92 => "Guyana", 93 => "Haiti", 94 => "Heard and Mc Donald Islands", 95 => "Holy See (Vatican City State)", 96 => "Honduras", 97 => "Hong Kong", 98 => "Hungary", 99 => "Iceland", 100 => "India", 101 => "Indonesia", 102 => "Iran (Islamic Republic of)", 103 => "Iraq", 104 => "Ireland", 105 => "Israel", 106 => "Italy", 107 => "Jamaica", 108 => "Japan", 109 => "Jordan", 110 => "Kazakhstan", 111 => "Kenya", 112 => "Kiribati", 113 => "Korea, Democratic People's Republic of", 114 => "Korea, Republic of", 115 => "Kuwait", 116 => "Kyrgyzstan", 117 => "Lao, People's Democratic Republic", 118 => "Latvia", 119 => "Lebanon", 120 => "Lesotho", 121 => "Liberia", 122 => "Libyan Arab Jamahiriya", 123 => "Liechtenstein", 124 => "Lithuania", 125 => "Luxembourg", 126 => "Macau", 128 => "Madagascar", 129 => "Malawi", 130 => "Malaysia", 131 => "Maldives", 132 => "Mali", 133 => "Malta", 134 => "Marshall Islands", 135 => "Martinique", 136 => "Mauritania", 137 => "Mauritius", 138 => "Mayotte", 139 => "Mexico", 140 => "Micronesia, Federated States of", 141 => "Moldova, Republic of", 142 => "Monaco", 143 => "Mongolia", 144 => "Montserrat", 145 => "Morocco", 146 => "Mozambique", 147 => "Myanmar", 148 => "Namibia", 149 => "Nauru", 150 => "Nepal", 151 => "Netherlands", 152 => "Netherlands Antilles", 153 => "New Caledonia", 154 => "New Zealand", 155 => "Nicaragua", 156 => "Niger", 157 => "Nigeria", 158 => "Niue", 159 => "Norfolk Island", 160 => "Northern Mariana Islands", 161 => "Norway", 162 => "Oman", 163 => "Pakistan", 164 => "Palau", 165 => "Panama", 166 => "Papua New Guinea", 167 => "Paraguay", 168 => "Peru", 169 => "Philippines", 170 => "Pitcairn", 171 => "Poland", 172 => "Portugal", 173 => "Puerto Rico", 174 => "Qatar", 175 => "Reunion", 176 => "Romania", 177 => "Russian Federation", 178 => "Rwanda", 179 => "Saint Kitts and Nevis", 180 => "Saint Lucia", 181 => "Saint Vincent and the Grenadines", 182 => "Samoa", 183 => "San Marino", 184 => "Sao Tome and Principe", 185 => "Saudi Arabia", 186 => "Senegal", 187 => "Seychelles", 188 => "Sierra Leone", 189 => "Singapore", 190 => "Slovakia (Slovak Republic)", 191 => "Slovenia", 192 => "Solomon Islands", 193 => "Somalia", 194 => "South Africa", 195 => "South Georgia and the South Sandwich Islands", 196 => "Spain", 197 => "Sri Lanka", 198 => "St. Helena", 199 => "St. Pierre and Miquelon", 200 => "Sudan", 201 => "Suriname", 202 => "Svalbard and Jan Mayen Islands", 203 => "Swaziland", 204 => "Sweden", 205 => "Switzerland", 206 => "Syrian Arab Republic", 207 => "Taiwan, Province of China", 208 => "Tajikistan", 209 => "Tanzania, United Republic of", 210 => "Thailand", 211 => "Togo", 212 => "Tokelau", 213 => "Tonga", 214 => "Trinidad and Tobago", 215 => "Tunisia", 216 => "Turkey", 217 => "Turkmenistan", 218 => "Turks and Caicos Islands", 219 => "Tuvalu", 220 => "Uganda", 221 => "Ukraine", 222 => "United Arab Emirates", 223 => "United Kingdom", 224 => "United States", 225 => "United States Minor Outlying Islands", 226 => "Uruguay", 227 => "Uzbekistan", 228 => "Vanuatu", 229 => "Venezuela", 230 => "Vietnam", 231 => "Virgin Islands (British)", 232 => "Virgin Islands (U.S.)", 233 => "Wallis and Futuna Islands", 234 => "Western Sahara", 235 => "Yemen", 236 => "Yugoslavia", 237 => "Zambia", 238 => "Zimbabwe"];
}
function getCountryListRu(){
    return [0=>'Украина',1=>'Россия',2=>'Абхазия',3=>'Австралия',4=>'Австрия',5=>'Азербайджан',6=>'Албания',7=>'Алжир',8=>'Ангилья',9=>'Ангола',10=>'Андорра',11=>'Антарктика',12=>'Аргентина',13=>'Армения',14=>'Аруба',15=>'Афганистан',16=>'Багамские Острова',17=>'Бангладеш',18=>'Барбадос',19=>'Беларусь',20=>'Белиз',21=>'Бельгия',22=>'Бенин',23=>'Болгария',24=>'Боливия',25=>'Босния и Герцеговина',26=>'Ботсвана',27=>'Бразилия',28=>'Бруней',29=>'Буве',30=>'Буркина-Фасо',31=>'Бурунди',32=>'Бутан',33=>'Вануату',34=>'Ватикан',35=>'Великобритания',36=>'Венгрия',37=>'Венесуэла',38=>'Вьетнам',39=>'Габон',40=>'Гаити',41=>'Гайана',42=>'Гамбия',43=>'Гана',44=>'Гваделупа',45=>'Гватемала',46=>'Гвиана',47=>'Гвинея',48=>'Гвинея-Бисау',49=>'Германия',50=>'Гернси',51=>'Гибралтар',52=>'Гондурас',53=>'Гонконг',54=>'Гренада',55=>'Гренландия',56=>'Греция',57=>'Грузия',58=>'Гуам',59=>'Дания',60=>'Джерси',61=>'Джибути',62=>'Доминика',63=>'Доминиканская Республика',64=>'Египет',65=>'Замбия',66=>'Западная Сахара',67=>'Зимбабве',68=>'Израиль',69=>'Индия',70=>'Индонезия',71=>'Иордания',72=>'Ирак',73=>'Иран',74=>'Ирландия',75=>'Исландия',76=>'Испания',77=>'Италия',78=>'Йемен',79=>'Кабо-Верде',80=>'Казахстан',81=>'Камбоджа',82=>'Камерун',83=>'Канада',84=>'Катар',85=>'Кения',86=>'Кипр',87=>'Китай',88=>'Колумбия',89=>'Косово',90=>'Коста-Рика',91=>'Куба',92=>'Кувейт',93=>'Кука острова',94=>'Кыргызстан',95=>'Лаос',96=>'Латвия',97=>'Лесото',98=>'Либерия',99=>'Ливан',100=>'Ливия',101=>'Литва',102=>'Лихтенштейн',103=>'Люксембург',104=>'Мадагаскар',105=>'Македония',106=>'Малави',107=>'Малайзия',108=>'Мали',109=>'Мальдивы',110=>'Мальта',111=>'Мексика',112=>'Микронезия',113=>'Мозамбик',114=>'Молдова',115=>'Монако',116=>'Монголия',117=>'Морокко',118=>'Намибия',119=>'Непал',120=>'Нигерия',121=>'Нидерланды',122=>'Никарагуа',123=>'Ниуэ',124=>'Новая Зеландия',125=>'Норвегия',126=>'Норфолк',127=>'Объединенные Арабские Эмираты',128=>'Оман',129=>'Пакистан',130=>'Палау',131=>'Палестина',132=>'Панама',133=>'Парагвай',134=>'Перу',135=>'Польша',136=>'Португалия',137=>'Приднестровье',138=>'Пуэрто-Рико',139=>'Республика Конго',140=>'Румыния',141=>'Сальвадор',142=>'Самоа',143=>'Саудовская Аравия',144=>'Свазиленд',145=>'Северная Корея',146=>'Сент-Люсия',147=>'Сербия',148=>'Сингапур',149=>'Сирия',150=>'Словакия',151=>'Словения',152=>'Соединенные Штаты Америки',153=>'Соломоновы Острова',154=>'Сомали',155=>'Сомалиленд',156=>'Судан',157=>'Суринам',158=>'Таджикистан',159=>'Таиланд',160=>'Тайвань',161=>'Танзания',162=>'Тёркс и Кайкос',163=>'Тонга',164=>'Тувалу',165=>'Тунис',166=>'Турецкая Республика Северного Кипра',167=>'Туркменистан',168=>'Турция',169=>'Уганда',170=>'Узбекистан',171=>'Уругвай',172=>'Фиджи',173=>'Филиппины',174=>'Финляндия',175=>'Франция',176=>'Хорватия',177=>'Черногория',178=>'Чехия',179=>'Чили',180=>'Швейцария',181=>'Швеция',182=>'Шри-Ланка',183=>'Эквадор',184=>'Экваториальная Гвинея',185=>'Эритрея',186=>'Эстония',187=>'Эфиопия',188=>'Южная Корея',189=>'Южная Осетия',190=>'Ямайка',191=>'Япония'];
}
function getLangList(){
    return ['en' => 'English' , 'ru' => 'Русский' , 'uk' => 'Українська' ,'aa' => 'Afar' ,'ab' => 'Abkhazian' ,'af' => 'Afrikaans' ,'am' => 'Amharic' ,'ar' => 'Arabic' ,'as' => 'Assamese' ,'ay' => 'Aymara' ,'az' => 'Azerbaijani' ,'ba' => 'Bashkir' ,'be' => 'Byelorussian' ,'bg' => 'Bulgarian' ,'bh' => 'Bihari' ,'bi' => 'Bislama' ,'bn' => 'Bengali/Bangla' ,'bo' => 'Tibetan' ,'br' => 'Breton' ,'ca' => 'Catalan' ,'co' => 'Corsican' ,'cs' => 'Czech' ,'cy' => 'Welsh' ,'da' => 'Danish' ,'de' => 'German' ,'dz' => 'Bhutani' ,'el' => 'Greek' ,'eo' => 'Esperanto' ,'es' => 'Spanish' ,'et' => 'Estonian' ,'eu' => 'Basque' ,'fa' => 'Persian' ,'fi' => 'Finnish' ,'fj' => 'Fiji' ,'fo' => 'Faeroese' ,'fr' => 'French' ,'fy' => 'Frisian' ,'ga' => 'Irish' ,'gd' => 'Scots/Gaelic' ,'gl' => 'Galician' ,'gn' => 'Guarani' ,'gu' => 'Gujarati' ,'ha' => 'Hausa' ,'hi' => 'Hindi' ,'hr' => 'Croatian' ,'hu' => 'Hungarian' ,'hy' => 'Armenian' ,'ia' => 'Interlingua' ,'ie' => 'Interlingue' ,'ik' => 'Inupiak' ,'in' => 'Indonesian' ,'is' => 'Icelandic' ,'it' => 'Italian' ,'iw' => 'Hebrew' ,'ja' => 'Japanese' ,'ji' => 'Yiddish' ,'jw' => 'Javanese' ,'ka' => 'Georgian' ,'kk' => 'Kazakh' ,'kl' => 'Greenlandic' ,'km' => 'Cambodian' ,'kn' => 'Kannada' ,'ko' => 'Korean' ,'ks' => 'Kashmiri' ,'ku' => 'Kurdish' ,'ky' => 'Kirghiz' ,'la' => 'Latin' ,'ln' => 'Lingala' ,'lo' => 'Laothian' ,'lt' => 'Lithuanian' ,'lv' => 'Latvian/Lettish' ,'mg' => 'Malagasy' ,'mi' => 'Maori' ,'mk' => 'Macedonian' ,'ml' => 'Malayalam' ,'mn' => 'Mongolian' ,'mo' => 'Moldavian' ,'mr' => 'Marathi' ,'ms' => 'Malay' ,'mt' => 'Maltese' ,'my' => 'Burmese' ,'na' => 'Nauru' ,'ne' => 'Nepali' ,'nl' => 'Dutch' ,'no' => 'Norwegian' ,'oc' => 'Occitan' ,'om' => '(Afan)/Oromoor/Oriya' ,'pa' => 'Punjabi' ,'pl' => 'Polish' , 'pt' => 'Portuguese' ,'qu' => 'Quechua' , 'ro' => 'Romanian' ,'rw' => 'Kinyarwanda' ,'sa' => 'Sanskrit' ,'sd' => 'Sindhi' ,'sg' => 'Sangro' ,'sh' => 'Serbo-Croatian' ,'si' => 'Singhalese' ,'sk' => 'Slovak' ,'sl' => 'Slovenian' ,'sm' => 'Samoan' ,'sn' => 'Shona' ,'so' => 'Somali' ,'sq' => 'Albanian' ,'sr' => 'Serbian' ,'ss' => 'Siswati' ,'st' => 'Sesotho' ,'su' => 'Sundanese' ,'sv' => 'Swedish' ,'sw' => 'Swahili' ,'ta' => 'Tamil' ,'te' => 'Tegulu' ,'tg' => 'Tajik' ,'th' => 'Thai' ,'ti' => 'Tigrinya' ,'tk' => 'Turkmen' ,'tl' => 'Tagalog' ,'tn' => 'Setswana' ,'to' => 'Tonga' ,'tr' => 'Turkish' ,'ts' => 'Tsonga' ,'tt' => 'Tatar' ,'tw' => 'Twi' ,'ur' => 'Urdu' ,'uz' => 'Uzbek' ,'vi' => 'Vietnamese' ,'vo' => 'Volapuk' ,'wo' => 'Wolof' ,'xh' => 'Xhosa' ,'yo' => 'Yoruba' ,'zh' => 'Chinese' ,'zu' => 'Zulu' ];
}
function getModelDate($date, $isLong =false){
    if (empty($date)) return "";
    if($isLong){
        return Yii::$app->formatter->asDate($date, "long");
    }else{
        return Yii::$app->formatter->asDate($date, "dd MMMM yyyy");
    }
}
function getModelDateWithTime($date){
    if (empty($date)) return "";
    return Yii::$app->formatter->asDatetime($date);
}

function addViewCountModel($model, $isProduct = false)
{
    $session = Yii::$app->session;
    $session->open();
    //set session id
    if( Yii::$app->user->isGuest ) {
        $session->setId('anonymous');
    }else{
        $session->setId("user-id". Yii::$app->user->identity->getId());
    }
    //set session value for each model
    $model_key = $isProduct ? "product/views/id".$model->id : "news/views/id".$model->id;
    if( is_null($session->get($model_key)))
    {
        $session->set($model_key , true);
        $model->views = $model->views + 1;
        $model->save(false);
        $session->close();
        return;
    }
    $session->close();
}

function unlink_if_exists($path){
    if(file_exists($path)) {
        return unlink($path);
    }else{
        return false;
    }
}

function addParamToGETLink($param,$val,$options = ["url"=>""]){
    if(array_key_exists($param,$_GET))
        unset($_GET[$param]);
    return \yii\helpers\Url::to(array_merge([$options["url"],$param => $val],$_GET));
}

/**Subscribes for news distribution on user email.
 * @param $email
 */
/*function Subscribe($email,$showMsg = true){
    if(\app\models\Subscriber::isExist($email)){
        if($showMsg)
            addAlert('warning', 'Вы уже подписаны на рассылку новостей!'));
        return;
    }
    $sub = new \app\models\Subscriber();
    $sub->email = $email;
    if ($sub->save()) {
        if($showMsg)
            addAlert('success', 'Вы успешно подписались на рассылку новостей');
    }else{
        debug($sub->getFirstErrors());die;
        if($showMsg)
            addAlert('danger', 'Не удалось подписаться! Попробуйте позже.');
    }
}*/
function languageSelectLayout($isSmall = false){
    $current = Yii::$app->language;
    switch ($current){
        case 'ru':
            return buildLanguageSelect('ru', 'uk', $isSmall); break;
        case 'uk':
            return buildLanguageSelect('uk', 'ru', $isSmall); break;
        default:
            return buildLanguageSelect('ru', 'uk', $isSmall); break;
    }
}

function buildLanguageSelect($active, $l2, $isSmall=false)
{
    $langs = Yii::$app->params['languages'];
    $link1 = \yii\helpers\Url::to(array_merge([Yii::$app->controller->id . "/" . Yii::$app->controller->action->id, "language" => $l2], Yii::$app->request->get()));

    if($isSmall){
        return "<ul>
                    <li><a class='active'>".$langs[$active]['title']."</a></li>
                    <li><a href='".$link1."'>".$langs[$l2]['title']."</a></li>
               </ul>";
    }else{
        return "<li class='click_control click_main fz-hd-18'><i class='fas fa-globe fa-lg'></i>".$langs[$active]['title'].
            "<ul class='control_item'>
                    <li class='lang'><a href='".$link1."'>".$langs[$l2]['title']."</a></li>
                </ul>
            </li>";
    }
}


function pushArrayToArray(&$primary, $array){
    if(empty($array))return;
    foreach ($array as $key=>$val){
        $primary[] = $val;
    }
}
/*function c_tools_beg($id, $pageName, $saveAction){
    return \bizley\contenttools\ContentTools::begin(['id'=>$id,  'page'=> $pageName, "saveEngine"=>["save"=>$saveAction],"imagesEngine"=>[
            'upload' => '/admin/content/page/content-tools-image-upload',
            'rotate' => '/admin/content/page/content-tools-image-rotate',
            'insert' => '/admin/content/page/content-tools-image-insert',
        ],
        "styles"=> \app\models\page\PageContent::getCommonStyleClasses()
    ]);
}
function c_tools_end(){
    return \bizley\contenttools\ContentTools::end();
}*/


/**
 * @param $objects
 * <u> properties required: id, name</u>
 * @return array id => name
 */
function getAsTransAssoc($objects){
    $arr = [];
    if (empty($objects))
        return $arr;
    foreach ($objects as $object){
        $arr[$object->id] = $object->name;
    }
    return $arr;
}

//TODO
function getRoute($route){
    $routes = [
        'main' => \yii\helpers\Url::to('/info/main'),
        'about' => \yii\helpers\Url::to('/info/about'),
        'delivery' => \yii\helpers\Url::to('/info/delivery'),
        'service' => \yii\helpers\Url::to('/info/service'),
        'sale' => \yii\helpers\Url::to('/info/sale'),
        'shop' => \yii\helpers\Url::to('/info/shop')
    ];
    return $routes[$route];
}

function getAsaidMenuAsLayout($active){
    $urlAbout = \yii\helpers\Url::to('/info/about');
    $urlDelivery = \yii\helpers\Url::to('/info/delivery');
    $urlComment = \yii\helpers\Url::to('/info/comment');
    $urlContact = \yii\helpers\Url::to('/info/contact');
    $aboutText = 'О нас';
    $deliveryText = 'Доставка';
    $commentText = 'Отзывы';
    $contactText = 'Контакты';
    $activeAbout = $active == 'about' ? 'class="active"':'';
    $activeDelivery = $active == 'delivery' ? 'class="active"':'';
    $activeComment = $active == 'comment' ? 'class="active"':'';
    $activeContact = $active == 'contact' ? 'class="active"':'';
    return <<<EOT
                <ul>
                    <li $activeAbout><a href="$urlAbout">$aboutText</a></li>
                    <li $activeDelivery><a href="$urlDelivery">$deliveryText</a></li>
                    <li $activeComment><a href="$urlComment">$commentText</a></li>
                    <li $activeContact><a href="$urlContact">$contactText</a></li>
                </ul>
EOT;

}


function registerCommonMetaTags($title,$description=null){
    Yii::$app->controller->view->registerMetaTag([
        'name' => 'title',
        'content' => $title. " | ".Yii::$app->name
    ]);
    $descriptionContent = \app\models\seo\SeoInfo::getValue(\app\models\seo\SeoInfo::KEY_SITE_DESC);
    if(!is_null($description))
        $descriptionContent = $description;
    Yii::$app->controller->view->registerMetaTag([
        'name' => 'description',
        'content' => $descriptionContent
    ]);
}

function numberFormat($number){
    return number_format($number,2,'.','');
}
?>