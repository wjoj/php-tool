<?php

namespace Wjoj\Tool;

use Exception;

/**
 * 错误throws
 * @author ccm wjoj
 * @copyright (c) 2023 02
 */
class Error extends Exception {
    /**
     * 上一个错误
     *
     * @var Error|null
     */
    protected Error|null $previous=null;

    /**
     *
     * @param string $err
     * @param integer $code
     * @param Error|null $previous
     */
    public function __construct(string $err,int $code=0,Error $previous = null){
        parent::__construct($err,$code);
        $this->previous = $previous;
    }
    
    public function __toString(): string {
        return json_encode($this);
    }
    
    /**
     * 获取错误信息
     *
     * @return array
     */
    public function getError(): array {
        return [];
    }
}