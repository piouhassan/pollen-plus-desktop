<?php

namespace AkConfig;

class App
{

    //  This is the unique place to change  Database Settings
    // Change the const value into your database value

         const  DB_HOST = 'localhost:3310';
         
         const DB_NAME = 'pollen_plus';

         const  DB_USER = 'root';
         const DB_PASS = '1012';

         const DB_PORT = 3310;

         const DB_CHARSET ="utf8";

    /**
     * Is only used  for illuminate database
     * @return array
     */
    public static function DB ()
    {
    return   [
      'driver' => 'mysql',
      'host'   => self::DB_HOST,
      'database' => self::DB_NAME,
      'username' => self::DB_USER,
      'password' => self::DB_PASS,
      'charset'  => self::DB_CHARSET,
      'collation' => 'utf8_unicode_ci',
      'prefix' => '',
    ];
    }
    public static function  NotFound()
    {
        return "
        <!DOCTYPE html>
     <html lang=\"en\">
    <head>
        <meta charset=\"utf-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">

        <title>Page Not Found</title>

        <!-- Fonts -->
        <link href=\"https://fonts.googleapis.com/css?family=Raleway:100,600\" rel=\"stylesheet\" type=\"text/css\">

        <!-- Styles -->
        <style>
            html, body {
                background: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 36px;
                padding: 20px;
                font-weight: bold;
            }
            
            .dashboard{
            position:  absolute;
            top: 60%;
            left: 50%;
            transform: translateX(-50%);
            padding: 10px 30px;
            border: 1px #1C49F1 solid;
            border-radius: 3px;
            color: #1C49F1;
            font-weight: bold;
            text-decoration: none
           
            }
            
             .dashboard:hover{
             color: #fff;
             background-color: #1C49F1;
             }
        </style>
    </head>
    <body>
        <div class=\"flex-center position-ref full-height\">
            <div class=\"content\">
                <div class=\"title\">
                   Désolé Un probleme est Survenue  <br></div>
            </div>
        </div>
<a href='/dashboard'  class='dashboard'>Retour</a>
    </body>
</html>
        
        ";
    }


}
