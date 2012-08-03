<?php

class bloqueComponents extends sfComponents {

	
        
	/**
	 * Bloque paginador
	 */
	public function executeBloquePaginador() {

		

        //añade ?page= o &page= al final
        $this->action .= ( preg_match('/\?/', $this->action) ? '&' : '?') . 'page=';
    }

}