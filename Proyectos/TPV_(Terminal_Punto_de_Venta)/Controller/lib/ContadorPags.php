<?php
class ContadorPags {
    //atributos
    private $pagRegs = 10; //Número de registros a recuperar de cada vez para la paginacíon
    private $iniReg; //Registro inicial a partir del que recuperar el $pagRegs
    private $numRegs; //Número de registros que tiene la tabla

    /**
     * Constructor para objetos ContadorPags
     *
     * @param integer $pagRegs Número de registros a recuperar de cada vez para la paginacíon
     * @param integer $numRegs Número de registros que tiene la tabla
     */
    public function __construct($pagRegs=10, $numRegs=0){
        $this->setPagRegs($pagRegs);
        $this->setNumRegs($numRegs);
        $this->iniReg = 0;
    }

    /**
     * Establece la cantidad de líneas por página
     *
     * @param [type] $pagRegs Número de líneas por página
     * @return void
     */
    private function setPagRegs($pagRegs){
        $this->pagRegs = $pagRegs > 0 ? $pagRegs : $this->pagRegs = 10;
    }

    /**
     * Establece la cantidad de registros que hay en total.
     *
     * @param integer $numRegs Número de registros que tiene la tabla
     * @return void
     */
    public function setNumRegs($numRegs) : void {
        $this->numRegs = $numRegs >= 0 ? $numRegs : $this->numRegs = 0;
    }

    /**
     * Calcula y devuelve el número de página actual
     *
     * @return integer Devuelve el número de página actual
     */
    public function numPagina(){
        return ($this->iniReg/$this->pagRegs) + 1;
    }

    /**
     * Calcula y devuelve la cantidad de páginas que se pueden mostrar
     *
     * @return integer Cantidad de páginas que se pueden mostrar
     */
    public function numPaginas(){
        return ceil($this->numRegs / $this->pagRegs);
    }

    /**
     * Varia el valor de la página actual a una posterior
     *
     * @return void
     */
    public function siguientePag(){
        if ($this->numPagina() < $this->numPaginas()) $this->iniReg+= $this->pagRegs;
    }

    /**
     * Varia el valor de la página actual a una anterior
     *
     * @return void
     */
    public function anteriorPag(){
        if ($this->iniReg >= $this->pagRegs) $this->iniReg-= $this->pagRegs;
    }

    /**
     * Devuelve el valor del inicio de registros a recuperar
     *
     * @return integer Índice del registro a partir del que recuperar los registros
     */
    public function getIniReg(){
        /*Como PHP mantiene la sesión y no puedo borrar la variable de sesión, por si se elimina
         el registro reduciría 1 página y la última vez que se accedió estaba en esta. */
        if($this->iniReg >= $this->numRegs) $this->iniReg = 0;
        return $this->iniReg;
    }

    /**
     * Devuelve cuantos registro recuperar
     *
     * @return integer Número de registros a recuperar de la tabla
     */
    public function getPagRegs(){
        return $this->pagRegs;
    }
}