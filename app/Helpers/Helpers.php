<?php

   /**
   * Create your custom global function
   *
   * @return response()
   */

    function test()
    {
        return 'helper class';
    }

    function upload($model, $file, $type, $main_folder, $create = false)
    {
        $date = now()->format('Y/m/d');
        
        $type = Str::slug($type);

        $path = "/{$main_folder}/{$type}";

        File::exists(storage_path('app/public/'.$path)) or File::makeDirectory(storage_path('app/public/'.$path), 0777, true);

        $file_name =  Str::random(10).$file->getClientOriginalName();

        $file_path = $file->storeAs($path, $file_name, 'public');

        $originalName = $file->getClientOriginalName();

        $extention = $file->getClientOriginalExtension();

        if ($create) {
            return $file_path;
        }

        $data = $model->create([
            'file_label_type' => $extention,
            'original_file_name' => $originalName,
            'display_file_name' => str_replace(".{$extention}", '', $originalName),
            'path_file' => $file_path,
            'extension_file' => $extention,
            'state' => 'in_review',
        ]);
    }

    function phone_validated($text) 
    {
        return preg_match('%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i', $text) && strlen($text) >= 10;;
    }

    function str_contains_all($string, $array, $caseSensitive = true)
    {
        if(0 < count(array_intersect(array_map('strtolower', explode(' ', $string)), $array)))
        {
            return true;
        }
        return false;
    }
    
    function format_number($number, $decimals = 0, $decPoint = '.' , $thousandsSep = ',')
    {
        $negation = ($number < 0) ? (-1) : 1;
        $coefficient = 10 ** $decimals;
        $number = $negation * floor((string)(abs($number) * $coefficient)) / $coefficient;
        return number_format($number, $decimals, $decPoint, $thousandsSep);
    }
?>