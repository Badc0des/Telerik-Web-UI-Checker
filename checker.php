<?php
// Telerik Web UI Scanner
// Code by Badc0de
// https://github.com/Badc0des
// TEING SAHA MANEH SIA KOPLOK

class Badc0de_TEL{
		public $site;

		public function save($text, $nama){
			$xyz = fopen($nama, "a+");
				   fwrite($xyz, "$text\n");
				   fclose($xyz);
		}
		public function cURL($targetmu){
			$get = curl_init();
				   curl_setopt($get, CURLOPT_URL, $targetmu);
				   curl_setopt($get, CURLOPT_RETURNTRANSFER, 1);
				   curl_setopt($get, CURLOPT_FOLLOWLOCATION, 1);
				   curl_setopt($get, CURLOPT_CUSTOMREQUEST, "GET");
				   curl_setopt($get, CURLOPT_USERAGENT, "Badc0de/1.0");
				   curl_setopt($get, CURLOPT_SSL_VERIFYPEER, 0);
				   curl_setopt($get, CURLOPT_SSL_VERIFYHOST, 0);
				   curl_setopt($get, CURLOPT_CONNECTTIMEOUT, 0);
				   curl_setopt($get, CURLOPT_TIMEOUT, 1);
			$result = curl_exec($get);
			return $result;
		}
		public function CekTel(){
			$path = array( "/Telerik.Web.UI.DialogHandler.aspx" );
			foreach ($path as $pathnya) {
				for ($xx=0; $xx < $pathnya; $xx++);
					$korban = $this->site."".$pathnya;
					$cekfile = $this->cURL($korban);
					if (strpos($cekfile, "Loading the dialog...")) {
						echo "    ".$korban." \e[0;31;46m{FOUND}\e[0m\n";
					$textfile = "$korban";
						$this->save($textfile, "Result.txt");
					} else {
						echo "    ".$korban." \e[1;37;41m{NOT FOUND}\e[0m\n";
					}
				}
			}
		}
$Banner ="###########################
#[Telerik Web UI Scanner] #
#   [Code by Badc0de]     #
###########################
";


$ngecek = new Badc0de_TEL();

echo $Banner."\n\n\n";

if(!isset($argv[1])) die("!! USE: php ".$argv[0]." list.txt\n");
if(!file_exists($argv[1])) die("!! File target ".$argv[1]." Not Found!!");
$list = explode("\n", file_get_contents($argv[1]));

foreach ($list as $korbanku){
	$ngecek->site = trim($korbanku);

    echo "[=] Target: ".$korbanku."\n";
    $ngecek->CekTel();
}
?>
