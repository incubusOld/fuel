<?php

namespace Fuel\Tasks;


use Fuel\Core\Module;

class Sitemap
{

    public static function run()
    {

        Module::load('news');
        $articles = \News\Model_Article::query()->order_by('updated_at', 'desc')->get();


        $xmlWriter = new \XMLWriter();
        $xmlWriter->openMemory();
        $xmlWriter->startDocument('1.0', 'UTF-8');
        $xmlWriter->setIndent(true);
        $xmlWriter->startElement('urlset');
        $xmlWriter->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        foreach ($articles as $item) {

            $xmlWriter->startElement('url');
            $xmlWriter->writeElement('loc', \Uri::base().'news/view/' . $item->id);
            $xmlWriter->writeElement('lastmod', \Date::forge($item->updated_at)->format("%Y-%m-%d"));
            $xmlWriter->endElement();

        }

        $xmlWriter->endElement();
        $xmlWriter->endDocument();

        if(\File::exists(DOCROOT.'/test.txt'))

        \File::update(DOCROOT.'/public', 'sitemap.xml', $xmlWriter->outputMemory());

    }



}
