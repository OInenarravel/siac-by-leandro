<?php

/**
 * Description of Paginacao
 *
 * @author leandro
 */
class Paginacao {

    private $iNumeroPagina;        // numero da pagina a ser exibida
    private $iQtdRegistrosPorPagina;        // quantidade de registros por pagina
    private $iQtdTotalRegistros;   // quantidade total de registros
    private $iPrimeiroRegistro;    // primeiro registro da pagina
    private $sPainelNavegacao;     // painel de navegação
    private $iTotalPaginas;        // numero total de paginas
    private $sPageName;            // nome da pagina que usara a paginacao de resultados [mod: nomeDaPagina.php?parametro=valor&]

    /**
     * Metodo construtor que inicia a classe com a quantidade de registros por 
     * pagina e a pagina que usara a paginacao
     * @param <int>    $iQtdRegistrosPorPagina 
     * @param <string> $sPageName 
     */
    function __construct($iQtdRegistrosPorPagina = 1, $iQtdTotalRegistros = 0, $sPageName = "index.php?") {
        $this->iQtdRegistrosPorPagina = $iQtdRegistrosPorPagina;
        $this->iQtdTotalRegistros = $iQtdTotalRegistros;
        $this->sPageName = $sPageName;
    }

    public function setINumeroPagina($iNumeroPagina = 1) {
        $this->iNumeroPagina = $iNumeroPagina;
        $this->calculaPrimeiroRegistro();
    }

    public function getINumeroPagina() {
        return $this->iNumeroPagina;
    }

    public function setIQtdRegistrosPorPagina($iQtdRegistrosPorPagina) {
        $this->iQtdRegistrosPorPagina = $iQtdRegistrosPorPagina;
    }

    public function getIQtdRegistrosPorPagina() {
        return $this->iQtdRegistrosPorPagina;
    }

    public function setIQtdTotalRegistros($iQtdTotalRegistros) {
        $this->iQtdTotalRegistros = $iQtdTotalRegistros;
    }

    public function getIQtdTotalRegistros() {
        return $this->iQtdTotalRegistros;
    }

    public function setIPrimeiroRegistro($iPrimeiroRegistro) {
        $this->iPrimeiroRegistro = $iPrimeiroRegistro;
    }

    public function getIPrimeiroRegistro() {
        return $this->iPrimeiroRegistro;
    }

    public function setSPainelNavegacao($sPainelNavegacao) {
        $this->sPainelNavegacao = $sPainelNavegacao;
    }

    public function getSPainelNavegacao() {
        $this->geraPainelNavegacao();
        return $this->sPainelNavegacao;
    }

    public function calculaPrimeiroRegistro() {
        $this->iPrimeiroRegistro = ($this->iNumeroPagina * $this->iQtdRegistrosPorPagina) - $this->iQtdRegistrosPorPagina;
    }

    public function calculaTotalPaginas() {
        $iTotalPaginas = $this->iQtdTotalRegistros / $this->iQtdRegistrosPorPagina;

        $this->iTotalPaginas = ceil($iTotalPaginas);
    }

    public function geraPainelNavegacao() {
        $this->calculaTotalPaginas();

        $prev = $this->iNumeroPagina - 1;
        $next = $this->iNumeroPagina + 1;

        // se página maior que 1 (um), então temos link para a página anterior
        if ($this->iNumeroPagina > 1) {
            $prev_link = "<a href='" . $this->sPageName . "?pagina=" . $prev . "'>< Anterior</a>";
            $primeira_pagina = "<a href='" . $this->sPageName . "pagina=1'>Primeira</a>";
        } else { // senão não há link para a página anterior
            $prev_link = "< Anterior";
            $primeira_pagina = "Primeira";
        }
        // se número total de páginas for maior que a página corrente,
        // então temos link para a próxima página
        if ($this->iTotalPaginas > $this->iNumeroPagina) {
            $next_link = "<a href='" . $this->sPageName . "pagina=" . $next . "'>Pr&oacute;xima ></a>";
            $ultima_pagina = "<a href='" . $this->sPageName . "pagina=" . $this->iTotalPaginas . "'>&Uacute;ltima</a>";
        } else {
            // senão não há link para a próxima página
            $next_link = "Pr&oacute;xima >";
            $ultima_pagina = "&Uacute;ltima";
        }


        $painel = "";
        for ($x = 1; $x <= $this->iTotalPaginas; $x++) {
            if ($x == $this->iNumeroPagina) {
                // se estivermos na página corrente, não exibir o link para visualização desta página
                $painel .= " |  " . $x . "  |";
            } else {
                $painel .= " |<a href='" . $this->sPageName . "pagina=" . $x . "'>  " . $x . "  </a>|";
            }
        }

        $painel = $primeira_pagina . " | " . $prev_link . " | " . $painel . " | " . $next_link . " | " . $ultima_pagina;

        $this->setSPainelNavegacao($painel);
    }

}

?>
