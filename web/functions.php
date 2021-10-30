<?php
function expexcel($attributes,$labels){
    $label = ['Т\р'];

    $outpul = "
                    <html xmlns:x=\"urn:schemas-microsoft-com:office:excel\">
                    <head>
                        <!--[if gte mso 9]>
                        <xml>
                            <x:ExcelWorkbook>
                                <x:ExcelWorksheets>
                                    <x:ExcelWorksheet>
                                        <x:Name>Sheet 1</x:Name>
                                        <x:WorksheetOptions>
                                            <x:Print>
                                                <x:ValidPrinterInfo/>
                                            </x:Print>
                                        </x:WorksheetOptions>
                                    </x:ExcelWorksheet>
                                </x:ExcelWorksheets>
                            </x:ExcelWorkbook>
                        </xml>
                        <![endif]-->
                        <style>
                        td,th{
                          font-family: 'Times New Roman', sans-serif;
                          border-collapse: collapse;
                          width: 100%;
                        }
                    
                         td,  th {
                          border: 1px solid #000;
                          padding: 4px;
                        }
                        th{
                            font-weight: bold;
                        }
                        </style>
                    </head>
                    
                    <body>
                    <table class='table'><tr><th>Т\р</th>";

    foreach ($labels as $item) {
        $outpul.="<th>$item</th>";
    }
    $outpul.="</tr>";
    return $outpul;
}