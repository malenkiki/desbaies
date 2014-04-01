desbaies
========

Some classes for create SQL query without SQL code. Allow execution too, but there are not ORM layer.

Simple example:

``` php
$db = new Malenki\DesBaies\DesBaies();
$db->select->add('foo');
$db->from->add('bar');
```

give:

``` sql
SELECT `foo`
FROM `bar`;
```

More complex example:

``` php
$db = new Malenki\DesBaies\DesBaies();
$db->select->add('foo', 'b')->add('foo2', 'b2');
$db->from->add('bar', 'b');
$db->from->add('bar2', 'b2');
$db->order->by('foo', 'b')->desc->by('foo2', 'b2');
```

give:

``` php
SELECT `b`.`foo`, `b2`.`foo2`
FROM `bar` AS `b`, `bar2` AS `b2`
ORDER BY `b`.`foo` DESC, `b2`.`foo2` ASC;
```

