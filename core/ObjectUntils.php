<?php
class ObjectUntils
{
    #  object parameters to mysql string => "`name`, `name_search`, `created_at`, `updated_at`"
    public static function mysqlParameters($obj)
    {
        if (!is_object($obj)) { return false; }

        $params = [];
        foreach ($obj as $key => $value) {
            $params[] = '`'.$key.'`';
        }
        return implode(", ",$params);
    }

    #  object parameters to mysql string => "`name`=?, `name_search=?`, `created_at=?`, `updated_at=?`"
    public static function mysqlParametersUpdate($obj) {

        if (!is_object($obj)) { return false; }

        $params = [];
        foreach ($obj as $key => $value) {
            $params[] = '`'.$key.'`=?';
        }
        return implode(", ",$params);
    }

    public static function parameters($obj)
    {

    }

    # to zamienia obiekt na table wartosci jesgo atrubutów
    # Stdandard Object (
    #   [name] => 'Kowalski'
    #   [email] => 'k.kowalski.example.com'
    #   [telefon] => '888 888 88'
    # )
    # => ['Kowalski','k.kowalski.example.com','888 888 88']
    public static function mysqlParametersValuesArray($obj)
    {
        if (!is_object($obj)) { return false; }

        $params = [];
        foreach ($obj as $key => $value) {
            $params[] = $value;
        }
        return $params;
    }

    # to zwraca atrubuty w formie strin z przecinaki => "name, email, telefon, ..."
    public static function mysqlParametersValues($obj)
    {
        if (!is_object($obj)) { return false; }

        $arr = ObjectUntils::mysqlParametersValuesArray($obj);
        return implode(", ",$arr);
    }

    # to cos daje nam tyle znaków zapytania ile jest parametrów => "?, ?, ?, ..."
    public static function mysqlParametersValuesPlaceholder($obj)
    {
        if (!is_object($obj)) { return false; }

        $params = [];
        foreach ($obj as $key => $value) {
            $params[] = '?';
        }
        return implode(", ",$params);
    }

    # convert object to array
    public static function toArray($obj)
    {
        if (is_array($obj)) {
            return $obj;
        }

        if (is_object($obj)) {
            return json_decode(json_encode($obj), true);
        } else {
            return false;
        }
    }
}
