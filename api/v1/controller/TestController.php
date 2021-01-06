<?php
namespace Api\v1\controller;

use Api\v1\Model\SampleModel;

class Testcontroller
{
    public function index()
    {
        return __FUNCTION__;
    }

    public function create()
    {
        return __FUNCTION__;
    }

    public function sampleModel()
    {
        return SampleModel::SampleModelMethod();
    }
}