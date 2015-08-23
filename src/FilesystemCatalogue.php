<?php

use Everzet\PersistedObjects\FileRepository;
use Everzet\PersistedObjects\ObjectIdentifier;

class FilesystemCatalogue implements Catalogue, ObjectIdentifier
{
    private $repo;

    public function __construct()
    {
        $this->repo = new FileRepository(__DIR__ . '/../db', $this);
    }

    public function addProduct(Product $product)
    {
        $this->repo->save($product);
    }

    public function productWithSku(Sku $sku)
    {
        return $this->repo->findById($sku);
    }

    public function getIterator()
    {
        return new ArrayIterator($this->repo->getAll());
    }

    public function clear()
    {
        $this->repo->clear();
    }

    public function getIdentity($object)
    {
        return $object->sku();
    }
}
