<?php
namespace App\Model;

use Mni\FrontYAML\Parser;

abstract class AbstractCollection
{
    const FOLDER_COLLECTION = '';
    const CACHE_FILE        = '';

    protected $collection;

    protected $yamlParser;

    public function __construct(Parser $yamlParser)
    {
        if (empty(static::CACHE_FILE)) {
            throw new RuntimeException('The cache file path is not defined!');
        }
        $this->yamlParser = $yamlParser;
        if (!file_exists(static::CACHE_FILE)) {
            $this->buildCache();
        } else {
            $this->collection = require static::CACHE_FILE;
        }
    }

    public function getAll()
    {
        return $this->collection;
    }

    public function getFromFile($file)
    {
        $result = [];
        if (file_exists($file)) {
            $doc            = $this->yamlParser->parse(file_get_contents($file));
            $result         = $doc->getYAML();
            $result['body'] = $doc->getContent();
        }
        return $result;
    }

    protected function buildCache()
    {
        if (empty(static::FOLDER_COLLECTION)) {
            throw new RuntimeException('The folder collection is not defined!');
        }
        foreach (glob(static::FOLDER_COLLECTION . '/*.md') as $file) {
            $doc = $this->yamlParser->parse(file_get_contents($file));
            $fields = $doc->getYAML();
            $this->collection[$file] = $fields;
        }
        uasort($this->collection, [ $this, 'order' ]);
        file_put_contents(static::CACHE_FILE, '<?php return ' . var_export($this->collection, true) . ';', LOCK_EX);
    }

    protected function order($a, $b)
    {
        return false;
    }
}
