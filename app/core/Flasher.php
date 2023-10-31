<?php

class Flasher {
    public static function setFlash($type, $message) {
        $_SESSION["flash"] = [
            "type" => $type,
            "message" => $message
        ];
    }

    public static function flash() {
        if (isset($_SESSION["flash"])) {
            echo "<div class='flash-message'>
                <div class='message " . $_SESSION["flash"]["type"] .  "'>
                    <p>" . $_SESSION["flash"]["message"] . "</p>
                    <ion-icon name='close-outline' class='closeFlashMessage'></ion-icon>
                </div>
            </div>";

            unset($_SESSION["flash"]);
        }
    }

    public static function setError($error, $nameInputs) {
        if (is_array($error)) {
            foreach ($nameInputs as $x) {
                $_SESSION["error"][$x] = $error[$x];
            }
        }
    }
}