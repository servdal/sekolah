<html>

<head>
<style>
@page {
  size: auto;
}
.printiki tr td {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 20px;
}


    @media print {
        -ms-transform: rotate(270deg);
        /* IE 9 */
        -webkit-transform: rotate(270deg);
        /* Chrome, Safari, Opera */
        transform: rotate(270deg);
}
</style>
</head>
<body>
	{!! $datatoprint !!}
</body>

</html>
