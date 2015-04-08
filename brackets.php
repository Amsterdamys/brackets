<?php

class Brackets {

    /**
     * @var null
     * container for brackets
     */
    private $brackets = null;

    public function __construct(){
        $this->prepareBrackets();

        return false;
    }

    /**
     * @return string
     * validate brackets
     */
    public function validate(){
        if($this->brackets === null) return $this->getResponse(3);

        while ($this->brackets != ''){
            $strlen_start   = strlen($this->brackets);

            $this->brackets = preg_replace('/(\(\)|\[\]|\{\})/', '', $this->brackets);

            $strlen_end     = strlen($this->brackets);

            if($strlen_start == $strlen_end && $this->brackets != '') return $this->getResponse(2);
        }

        return $this->getResponse(1);
    }

    /**
     * check brackets
     */
    private function prepareBrackets(){
        if(isset($_GET['brackets'])){
            $this->brackets = preg_replace('/[^\(\)\[\]\{\}]/', '', $_GET['brackets']);
        }
    }

    /**
     * @param bool $result
     * @return string
     * returns the colored resulting string
     */
    private function getResponse($result){
        switch($result){
            case 1:
                $response = '<span style="color:green">String is correct</span>';
                break;
            case 2:
                $response = '<span style="color:red">String is incorrect</span>';
                break;
            case 3:
                $response = 'Brackets is empty';
                break;
        }

        return $response;
    }

}

$brackets = new Brackets();

echo $brackets->validate();

?>

<html>
<head>
</head>
<body>
    <form action="">
        <br>
        <input name="brackets" value="<?=isset($_GET['brackets'])?$_GET['brackets']:'{}{{[[{}]]}[]}'?>" /><br>
        <br>
        <button>Отправить</button>
    </form>
</body>
</html>
