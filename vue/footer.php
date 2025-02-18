<?php
class ViewFooter implements interfaceView{
    public function displayView():string{
        ob_start();
?>
            <footer>
                <p>Mentions Légales</p>
            </footer>

        </body>
        </html>
<?php
        $view = ob_get_clean();
        return $view;
    }
}