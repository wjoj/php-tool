<?php

namespace Wjoj\Tool;

/** 
 * Summary of Path
 * @author ccm wjoj
 * @copyright (c) 2023 01
 */
class Path
{
    private string $protocol = '';
    private string $type = '';
    private string $host = '';

    private string $uri = '';
    private string $extension = '';
    private string $name = '';
    private string $path = '';
    private string $divSymbols = '/';
    public function __construct(string $path)
    {
        $this->protocol = strstr($path, ':', true);
        if (in_array($this->protocol, array(
            'http',
            'https'
        ))) {
            $this->type = 'url';
            $semicolonIndex = strpos($path, ':');
            $t = substr($path,  $semicolonIndex  + 1);
            if ($index = strpos($t, '//') !== false) {
                $t = substr($t,  $index + 1);
                $slashIndex = strpos($t, '/') ?: null;
                $this->host = substr($t, 0, $slashIndex);
                $t = substr($t, $slashIndex !== null ? $slashIndex + 1 : strlen($this->host));
            }
        } else if ($this->protocol !== false) {
            $this->type = 'path';
            $semicolonIndex = strpos($path, ':');
            $t = substr($path,  $semicolonIndex  + 1);
        } else {
            $this->type = '';
            $t = $path;
        }

        $this->divSymbols = strpos($t, '/') !== false ? '/' : "\\";

        $ts =  explode($this->divSymbols, $t);
        $fname = count($ts) > 0 ? $ts[count($ts) - 1] : '';
        $fnames = explode('.', $fname);

        $this->name = count($fnames) > 0 ? $fnames[0] : '';
        $this->extension = count($fnames) > 1 ? $fnames[count($fnames) - 1] : '';

        $ts = array_slice($ts, 0, count($ts) - 1);
        $this->uri = implode($this->divSymbols, $ts);

        $this->path = $path;
    }

    public function getProtocol(): string
    {
        return $this->protocol;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getPath(): string
    {
        return $this->path;
    }
    public function getURI(): string
    {
        return $this->uri;
    }
    public function getExtension(): string
    {
        return $this->extension;
    }
    public function getName(): string
    {
        return $this->name;
    }
    /**
     * @return array<string,string>
     */
    public function getObject()
    {
        return get_object_vars($this);
    }

    public function __toString()
    {
        return json_encode($this->getObject(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    /**
     * Summary of new
     * @param string $addpath
     * @return static
     */
    public function newAdd(string $addpath)
    {
        if (strpos($addpath, '/') === 0 || strpos($addpath, '\\') === 0) {
            return new static($this->path . $addpath);
        }
        return new static($this->path . $this->divSymbols . $addpath);
    }

    /**
     * @param string $path
     * @return static
     */
    public function new(string $name)
    {
        $p = ($this->type == 'url' ? '//'  : "") . $this->host;
        if (strpos($name, '/') === 0 || strpos($name, '\\') === 0) {
            return new static($this->protocol . ':' . $p . $this->uri . $name);
        }
        return new static($this->protocol . ':' . $this->uri . $p . $this->divSymbols . $name);
    }
    /**
     * Summary of isDir
     * @return bool
     */
    public function isDir()
    {
        return is_dir($this->path);
    }
    /**
     * Summary of isFile
     * @return bool
     */
    public function isFile()
    {
        return is_file($this->path);
    }
    /**
     * Summary of isExtension
     * @param array $ext
     * @return bool
     */
    public function isExtension(array $ext)
    {
        return in_array($this->extension, $ext);
    }
    /**
     * Summary of open
     * @param mixed $mode
     * @param mixed $use_include_path
     * @param mixed $context
     * @return bool|resource
     */
    public function open($mode = 'w+', $use_include_path = false, $context = null)
    {
        return fopen($this->path, $mode, $use_include_path, $context);
    }
    /**
     * Summary of curlFile
     * @return \CURLFile
     */
    public function curlFile()
    {
        return curl_file_create($this->path, null, $this->name . '.' . $this->extension);
    }
}
