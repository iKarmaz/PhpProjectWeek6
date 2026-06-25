<?php

$name = htmlspecialchars($_POST['name']);

$gross_income = $_POST['gross_income'];
$deductions = $_POST['deductions'];


if (!is_numeric($gross_income) || !is_numeric($deductions))
{
    die("Income and deductions must be numeric values.");
}


if ($deductions < 15000)
{
    $deductions = 15000;
}


$adjusted_income = $gross_income - $deductions;


$tax10 = 0;
$tax12 = 0;
$tax22 = 0;
$tax24 = 0;
$tax32 = 0;
$tax35 = 0;
$tax37 = 0;


if ($adjusted_income > 0)
{
    $taxable = min($adjusted_income, 11600);
    $tax10 = $taxable * 0.10;
}


if ($adjusted_income > 11600)
{
    $taxable = min($adjusted_income, 47150) - 11600;
    $tax12 = $taxable * 0.12;
}


if ($adjusted_income > 47150)
{
    $taxable = min($adjusted_income, 100525) - 47150;
    $tax22 = $taxable * 0.22;
}


if ($adjusted_income > 100525)
{
    $taxable = min($adjusted_income, 191950) - 100525;
    $tax24 = $taxable * 0.24;
}


if ($adjusted_income > 191950)
{
    $taxable = min($adjusted_income, 243725) - 191950;
    $tax32 = $taxable * 0.32;
}


if ($adjusted_income > 243725)
{
    $taxable = min($adjusted_income, 609350) - 243725;
    $tax35 = $taxable * 0.35;
}


if ($adjusted_income > 609350)
{
    $taxable = $adjusted_income - 609350;
    $tax37 = $taxable * 0.37;
}


$total_taxes =
$tax10 +
$tax12 +
$tax22 +
$tax24 +
$tax32 +
$tax35 +
$tax37;


$gross_percent = ($total_taxes / $gross_income) * 100;
$adjusted_percent = ($total_taxes / $adjusted_income) * 100;

?>


<!DOCTYPE html>

<html>
<head>
    <title>Tax Results</title>
</head>

<body>

<h1>Tax Calculator Results for <?php echo $name; ?></h1>


<?php echo "$" . number_format($gross_income, 2); ?>

<br><br>


<?php echo "$" . number_format($deductions, 2); ?>

<br><br>


<?php echo "$" . number_format($adjusted_income, 2); ?>

<br><br>


<?php echo "$" . number_format($tax10, 2); ?>

<br><br>


<?php echo "$" . number_format($tax12, 2); ?>

<br><br>


<?php echo "$" . number_format($tax22, 2); ?>

<br><br>


<?php echo "$" . number_format($tax24, 2); ?>

<br><br>


<?php echo "$" . number_format($tax32, 2); ?>

<br><br>


<?php echo "$" . number_format($tax35, 2); ?>

<br><br>


<?php echo "$" . number_format($tax37, 2); ?>

<br><br>


<?php echo "$" . number_format($total_taxes, 2); ?>

<br><br>


<?php echo number_format($gross_percent, 2) . "%"; ?>

<br><br>


<?php echo number_format($adjusted_percent, 2) . "%"; ?>

</body>
</html>