<?php

namespace App\Twig;

use DateTime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class FilterTwig extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('price', [$this, 'formatPrice']),
            new TwigFilter('stars', [$this, 'stars'], ['is_safe' => ['html']]),
            new TwigFilter('dateFr', [$this, 'dateFr']),
            new TwigFilter('formatPhone', [$this, 'formatPhone']),
        ];
    }

    public function formatPrice($number, $symbol = '€', $decimals = 0, $decPoint = '.', $thousandsSep = ',')
    {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        $price = $price.' '.$symbol;

        return $price;
    }

    public function stars($note)
    {
        $html = '';
        for ($i = 0; $i < $note; $i++) {
            $html .= '<i class="fas fa-star"></i>';
        }
        for ($i = 0; $i < 5 - $note; $i++) {
            $html .= '<i class="far fa-star"></i>';
        }

        return $html;
    }

    public function dateFr($datetime){

        $date = new DateTime($datetime, new \DateTimeZone('Europe/Paris'));
        $date = date_format($date, 'd/m/Y');

        return $date;
    }

    public function formatPhone($phone){
        $phone = preg_replace('/[^0-9]/', '', $phone);
        $phone = preg_replace('/^33/', '0', $phone);
        $phone = preg_replace('/^0/', '+33', $phone);
        $phone = preg_replace('/^(\+33)(\d{1})(\d{2})(\d{2})(\d{2})(\d{2})$/', '$1 $2 $3 $4 $5 $6', $phone);

        return $phone;
    }
}