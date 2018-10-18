<?php
    class View
    {
        public $uri;
        public $path;
        public $head = "./views/layouts/head.html";
        public $foot = "./views/layouts/foot.html";

        public function __construct($uri)
        {
            $this->uri = $uri;
            $this->path = "./views" . $uri . ".html";
        }

        public function makeMenu()
        {
            $dir = scandir("./views");
            // print_r($dir);
            $listeMenu = array_diff($dir,[
                '.',
                '..',
                'layouts',
                '_404.html',
            ]);
            $ulMenu = "<ul>";
            foreach ($listeMenu as $key => $value) {
                $value = substr($value,0,strpos($value, "."));
                $ulMenu .= "<li><a href='/".$value."'>".$value."</a></li>";
            }
            $ulMenu .= "</ul>";
            return $ulMenu;
        }

        public function listeContent()
        {
            $dir = scandir("./views");
            // print_r($dir);
            $listeMenu = array_diff($dir,[
                '.',
                '..',
                'layouts',
                'Accueil.html',
                '_404.html',
            ]);
                $contentFiles = "";
            foreach ($listeMenu as $key => $value) {
                $contentFiles .=  file_get_contents('./views/'.$value). '<br>';
            }
            return $contentFiles;
        }

        public function renderView()
        {
            if(file_exists($this->path)){
                $content = file_get_contents($this->path);
            } elseif ($this->uri == "/" || $this->uri == ""){
                $content = file_get_contents('./views/Accueil.html');
            } else {
                $content = file_get_contents('./views/_404.html');
            }
            if($this->uri == "/" || $this->uri == "" || $this->uri == "/Accueil" ){
                echo file_get_contents($this->head) . $this->makeMenu() . $content . $this->listeContent() . file_get_contents($this->foot);   
            }else{
            echo file_get_contents($this->head) . $this->makeMenu() . $content . file_get_contents($this->foot);
            }
        }
    }