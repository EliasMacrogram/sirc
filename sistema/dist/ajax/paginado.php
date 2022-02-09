<?php
    function Paginacion($totalItems = 100, $itemsForPage = 10, $pagina = 1){
        $paginas = intval(ceil($totalItems / $itemsForPage));

        $paginacion = "<nav aria-label='Navigation'>";
        $paginacion .= "<ul class='justify-content-center justify-content-lg-start pagination pagination-sm'>";

        if ($paginas <= 5) {
            for ($i = 0; $i < $paginas; $i++) {
                $paginacion .= "<li class='page-item " . ($pagina == ($i + 1) ? 'active' : '') . "'> <a href='javascript:;' class='page-link' data-pagina='" . ($i + 1) . "' > " . ($i + 1) . " </a> </li>";
            }
        } else if ($paginas >= 7) {
            if ($pagina < 3) {
                for ($i = 0; $i < 3; $i++) {
                    $itne = ($i+1);
                    $paginacion .= "<li class='page-item " . ($pagina == ($i + 1) ? 'active' : '') . "'> <a href='javascript:;' class='page-link' data-pagina='" . ($i + 1) . "' > " . ($i + 1) . " </a> </li>";
                }
                $paginacion .= "<li class='page-item'> <a href='javascript:;' class='page-link'>...</a> </li>";
                $paginacion .= "<li class='page-item'> <a href='javascript:;' class='page-link' data-pagina='" . ($pagina + 1) . "' >&gt; </a> </li>";
                $paginacion .= "<li class='page-item'> <a href='javascript:;' class='page-link' data-pagina=$paginas>&gt;|</a> </li>";
            } else if (($paginas - 3) >= $pagina && $pagina >= 3) {
                $paginacion .= "<li class='page-item'> <a href='javascript:;' class='page-link' data-pagina=1>|&lt;</a> </li>";
                $paginacion .= "<li class='page-item'> <a href='javascript:;' class='page-link' data-pagina=" . ($pagina - 1) . "s>&lt;</a> </li>";
                $paginacion .= "<li class='page-item'> <a href='javascript:;' class='page-link'>...</a> </li>";
                for ($i = ($pagina - 2); $i < ($pagina + 1); $i++) {
                    $paginacion .= "<li class='page-item " . ($pagina == ($i + 1) ? 'active' : '') . "'> <a href='javascript:;' class='page-link' data-pagina='" . ($i + 1) . "'> " . ($i + 1) . " </a> </li>";
                }
                $paginacion .= "<li class='page-item'> <a href='javascript:;' class='page-link'>...</a> </li>";
                $paginacion .= "<li class='page-item'> <a href='javascript:;' class='page-link' data-pagina='" . ($pagina + 1) . "'>&gt;</a> </li>";
                $paginacion .= "<li class='page-item'> <a href='javascript:;' class='page-link' data-pagina=$paginas>&gt;|</a> </li>";
            } else {
                $paginacion .= "<li class='page-item'> <a href='javascript:;' class='page-link' data-pagina=1>|&lt;</a> </li>";
                $paginacion .= "<li class='page-item'> <a href='javascript:;' class='page-link' data-pagina=" . ($pagina - 1) . "s>&lt;</a> </li>";
                $paginacion .= "<li class='page-item'> <a href='javascript:;' class='page-link'>...</a> </li>";
                for ($i = ($paginas - 3); $i < $paginas; $i++) {
                    $paginacion .= "<li class='page-item " . ($pagina == ($i + 1) ? 'active' : '') . "'> <a href='javascript:;' class='page-link' data-pagina='" . ($i + 1) . "'> " . ($i + 1) . " </a> </li>";
                }
            }
        }

        $paginacion .= "</ul>";
        $paginacion .= "</nav>";
        // $paginacion .= "<br><p> Total: ".$totalItems."</p>";
        // $paginacion .= "<br><p> Pagina: ".$pagina." - Mostrando de: ".$itemsForPage."</p>";
        return $paginacion;
    }