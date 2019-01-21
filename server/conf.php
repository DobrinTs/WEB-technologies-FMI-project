<?php
  $vhosts =  <<<EOT
  #############################
  ## MP-1.10.1: w11ref.w3c.fmi.uni-sofia.bg
  #############################
  <VirtualHost *:80>
  	ServerAdmin    milenp@fmi.uni-sofia.bg
  	DocumentRoot   "C:/xampp/htdocs/w11ref.w3c.fmi.uni-sofia.bg/_PUB"
  	DirectoryIndex index.php
  	ServerName     w11ref.w3c.fmi.uni-sofia.bg
  #    ServerAlias    9999.w3c.fmi.uni-sofia.bg

  	<Directory "C:/BACKUP_SYSTEMS/htdocs/w11ref.w3c.fmi.uni-sofia.bg/_PUB">
  		Options       All
  		AllowOverride All
  		Require       all granted
  	</Directory>
  </VirtualHost>
EOT;

  //echo "<pre>$vhosts .  </pre>";echo "<pre>$vhosts .  </pre>";
  // $configs = include('conf.php');

  //if - uncomment/comment -> in calling part can be used as $configs['vhosts'];
  return (object) array(
    //0. sys_cfg
    'cfg_ver' => '1',
    //1. sys_cfg
    'cfg_system_mgmt' => 'w11ref',
    'cfg_system_name' =>'www_11ed_referats',
    'cfg_dns_prefix' => 'w11ref',
    'cfg_dns_sufix' => 'w3c.fmi.uni-sofia.bg',
    'HTTP_URL_PREFIX' => "http://w11ref.w3c.fmi.uni-sofia.bg",
    //2. db_cfg (from queries.php)
    'DB_SERVERNAME' => '127.0.0.1',
    'DB_USERNAME' => 'root',
    'DB_PASSWORD' => '',
    'DB_NAME' => '81265tripsdb',
    //9. vhost
    'vhosts' => $vhosts,
    'vhosts_ServerAdmin' => 'milenp@fmi.uni-sofia.bg',
    'vhosts_DocumentRoot' => 'C:/xampp/htdocs/w11ref.w3c.fmi.uni-sofia.bg/_PUB',
    'vhosts_port' => 80,
    'vhosts_ServerName' => 'w11ref.w3c.fmi.uni-sofia.bg',

  );
