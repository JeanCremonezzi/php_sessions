<?php

    function messagesList($msgs) {
        $element = "123";

        $element = array_map(
            function ($msg) {
                return "
                    <div class='card mt-3' style='width: 100%;'>
                        <div class='card-body'>
                            <h5 class='card-title'>".$msg["date"]."</h5>
                            <p class='card-text'>".$msg["text"]."</p>
                        </div>
                    </div>
                ";
            }, $msgs
        );

        return implode("", $element);
    }
?>