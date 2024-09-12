@extends('layout.app')
@section('title', 'Dashboard')

@section('content')
    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Dashboard</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Dashboard
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <div class="dropdown">
                        <a id="dropdownMenuButton" class="btn btn-primary dropdown-toggle" href="#" role="button"
                            data-toggle="dropdown">
                            <!-- Teks dropdown akan diubah oleh JavaScript -->
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" id="monthDropdown">
                            <!-- JavaScript akan menambahkan bulan-bulan di sini -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white pd-20 card-box mb-30">
            <div id="chart4" data-highcharts-chart="2">
                <div id="highcharts-pr1hfv0-9" dir="ltr" class="highcharts-container "
                    style="position: relative; overflow: hidden; width: 1020px; height: 400px; text-align: left; line-height: normal; z-index: 0; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                    <svg version="1.1" class="highcharts-root"
                        style="font-family:&quot;Lucida Grande&quot;, &quot;Lucida Sans Unicode&quot;, Arial, Helvetica, sans-serif;font-size:12px;"
                        xmlns="http://www.w3.org/2000/svg" width="1020" height="400" viewBox="0 0 1020 400">
                        <desc>Created with Highcharts 6.0.7</desc>
                        <defs>
                            <clipPath id="highcharts-pr1hfv0-10">
                                <rect x="0" y="0" width="941" height="263" fill="none"></rect>
                            </clipPath>
                        </defs>
                        <rect fill="#ffffff" class="highcharts-background" x="0" y="0" width="1020" height="400"
                            rx="0" ry="0"></rect>
                        <rect fill="none" class="highcharts-plot-background" x="69" y="63" width="941" height="263">
                        </rect>
                        <g class="highcharts-pane-group"></g>
                        <g class="highcharts-grid highcharts-xaxis-grid ">
                            <path fill="none" class="highcharts-grid-line" d="M 146.5 63 L 146.5 326" opacity="1">
                            </path>
                            <path fill="none" class="highcharts-grid-line" d="M 225.5 63 L 225.5 326" opacity="1">
                            </path>
                            <path fill="none" class="highcharts-grid-line" d="M 303.5 63 L 303.5 326" opacity="1">
                            </path>
                            <path fill="none" class="highcharts-grid-line" d="M 382.5 63 L 382.5 326" opacity="1">
                            </path>
                            <path fill="none" class="highcharts-grid-line" d="M 460.5 63 L 460.5 326" opacity="1">
                            </path>
                            <path fill="none" class="highcharts-grid-line" d="M 539.5 63 L 539.5 326" opacity="1">
                            </path>
                            <path fill="none" class="highcharts-grid-line" d="M 617.5 63 L 617.5 326" opacity="1">
                            </path>
                            <path fill="none" class="highcharts-grid-line" d="M 695.5 63 L 695.5 326" opacity="1">
                            </path>
                            <path fill="none" class="highcharts-grid-line" d="M 774.5 63 L 774.5 326" opacity="1">
                            </path>
                            <path fill="none" class="highcharts-grid-line" d="M 852.5 63 L 852.5 326" opacity="1">
                            </path>
                            <path fill="none" class="highcharts-grid-line" d="M 931.5 63 L 931.5 326" opacity="1">
                            </path>
                            <path fill="none" class="highcharts-grid-line" d="M 1009.5 63 L 1009.5 326" opacity="1">
                            </path>
                            <path fill="none" class="highcharts-grid-line" d="M 68.5 63 L 68.5 326" opacity="1">
                            </path>
                        </g>
                        <g class="highcharts-grid highcharts-yaxis-grid ">
                            <path fill="none" stroke="#e6e6e6" stroke-width="1" class="highcharts-grid-line"
                                d="M 69 326.5 L 1010 326.5" opacity="1"></path>
                            <path fill="none" stroke="#e6e6e6" stroke-width="1" class="highcharts-grid-line"
                                d="M 69 273.5 L 1010 273.5" opacity="1"></path>
                            <path fill="none" stroke="#e6e6e6" stroke-width="1" class="highcharts-grid-line"
                                d="M 69 221.5 L 1010 221.5" opacity="1"></path>
                            <path fill="none" stroke="#e6e6e6" stroke-width="1" class="highcharts-grid-line"
                                d="M 69 168.5 L 1010 168.5" opacity="1"></path>
                            <path fill="none" stroke="#e6e6e6" stroke-width="1" class="highcharts-grid-line"
                                d="M 69 116.5 L 1010 116.5" opacity="1"></path>
                            <path fill="none" stroke="#e6e6e6" stroke-width="1" class="highcharts-grid-line"
                                d="M 69 62.5 L 1010 62.5" opacity="1"></path>
                        </g>
                        <rect fill="none" class="highcharts-plot-border" x="69" y="63" width="941" height="263">
                        </rect>
                        <g class="highcharts-axis highcharts-xaxis ">
                            <path fill="none" class="highcharts-tick" stroke="#ccd6eb" stroke-width="1"
                                d="M 146.5 326 L 146.5 336" opacity="1"></path>
                            <path fill="none" class="highcharts-tick" stroke="#ccd6eb" stroke-width="1"
                                d="M 225.5 326 L 225.5 336" opacity="1"></path>
                            <path fill="none" class="highcharts-tick" stroke="#ccd6eb" stroke-width="1"
                                d="M 303.5 326 L 303.5 336" opacity="1"></path>
                            <path fill="none" class="highcharts-tick" stroke="#ccd6eb" stroke-width="1"
                                d="M 382.5 326 L 382.5 336" opacity="1"></path>
                            <path fill="none" class="highcharts-tick" stroke="#ccd6eb" stroke-width="1"
                                d="M 460.5 326 L 460.5 336" opacity="1"></path>
                            <path fill="none" class="highcharts-tick" stroke="#ccd6eb" stroke-width="1"
                                d="M 539.5 326 L 539.5 336" opacity="1"></path>
                            <path fill="none" class="highcharts-tick" stroke="#ccd6eb" stroke-width="1"
                                d="M 617.5 326 L 617.5 336" opacity="1"></path>
                            <path fill="none" class="highcharts-tick" stroke="#ccd6eb" stroke-width="1"
                                d="M 695.5 326 L 695.5 336" opacity="1"></path>
                            <path fill="none" class="highcharts-tick" stroke="#ccd6eb" stroke-width="1"
                                d="M 774.5 326 L 774.5 336" opacity="1"></path>
                            <path fill="none" class="highcharts-tick" stroke="#ccd6eb" stroke-width="1"
                                d="M 852.5 326 L 852.5 336" opacity="1"></path>
                            <path fill="none" class="highcharts-tick" stroke="#ccd6eb" stroke-width="1"
                                d="M 931.5 326 L 931.5 336" opacity="1"></path>
                            <path fill="none" class="highcharts-tick" stroke="#ccd6eb" stroke-width="1"
                                d="M 1010.5 326 L 1010.5 336" opacity="1"></path>
                            <path fill="none" class="highcharts-tick" stroke="#ccd6eb" stroke-width="1"
                                d="M 68.5 326 L 68.5 336" opacity="1"></path>
                            <path fill="none" class="highcharts-axis-line" stroke="#ccd6eb" stroke-width="1"
                                d="M 69 326.5 L 1010 326.5"></path>
                        </g>
                        <g class="highcharts-axis highcharts-yaxis "><text x="25.386425018310547" text-anchor="middle"
                                transform="translate(0,0) rotate(270 25.386425018310547 194.5)"
                                class="highcharts-axis-title" style="color:#666666;fill:#666666;" y="194.5">
                                <tspan>Rainfall (mm)</tspan>
                            </text>
                            <path fill="none" class="highcharts-axis-line" d="M 69 63 L 69 326"></path>
                        </g>
                        <path fill="none" class="highcharts-crosshair highcharts-crosshair-category undefined"
                            stroke="rgba(204,214,235,0.25)" stroke-width="78.41666666666667" style="pointer-events:none;"
                            visibility="hidden" d="M 421.5 63 L 421.5 326"></path>
                        <g class="highcharts-series-group">
                            <g class="highcharts-series highcharts-series-0 highcharts-column-series highcharts-color-0  highcharts-tracker"
                                transform="translate(69,63) scale(1 1)" clip-path="url(#highcharts-pr1hfv0-10)">
                                <rect x="18" y="212" width="8" height="52" fill="#7cb5ec"
                                    class="highcharts-point highcharts-color-0 "></rect>
                                <rect x="96" y="189" width="8" height="75" fill="#7cb5ec"
                                    class="highcharts-point highcharts-color-0 "></rect>
                                <rect x="175" y="152" width="8" height="112" fill="#7cb5ec"
                                    class="highcharts-point highcharts-color-0 "></rect>
                                <rect x="253" y="128" width="8" height="136" fill="#7cb5ec"
                                    class="highcharts-point highcharts-color-0 "></rect>
                                <rect x="332" y="113" width="8" height="151" fill="rgb(124,181,236)"
                                    class="highcharts-point highcharts-color-0 "></rect>
                                <rect x="410" y="79" width="8" height="185" fill="#7cb5ec"
                                    class="highcharts-point highcharts-color-0"></rect>
                                <rect x="489" y="121" width="8" height="143" fill="#7cb5ec"
                                    class="highcharts-point highcharts-color-0"></rect>
                                <rect x="567" y="108" width="8" height="156" fill="#7cb5ec"
                                    class="highcharts-point highcharts-color-0"></rect>
                                <rect x="645" y="36" width="8" height="228" fill="#7cb5ec"
                                    class="highcharts-point highcharts-color-0"></rect>
                                <rect x="724" y="60" width="8" height="204" fill="#7cb5ec"
                                    class="highcharts-point highcharts-color-0"></rect>
                                <rect x="802" y="163" width="8" height="101" fill="#7cb5ec"
                                    class="highcharts-point highcharts-color-0"></rect>
                                <rect x="881" y="207" width="8" height="57" fill="#7cb5ec"
                                    class="highcharts-point highcharts-color-0"></rect>
                            </g>
                            <g class="highcharts-markers highcharts-series-0 highcharts-column-series highcharts-color-0 "
                                transform="translate(69,63) scale(1 1)" clip-path="none"></g>
                            <g class="highcharts-series highcharts-series-1 highcharts-column-series highcharts-color-1  highcharts-tracker"
                                transform="translate(69,63) scale(1 1)" clip-path="url(#highcharts-pr1hfv0-10)">
                                <rect x="30" y="176" width="8" height="88" fill="#434348"
                                    class="highcharts-point highcharts-color-1 "></rect>
                                <rect x="108" y="181" width="8" height="83" fill="#434348"
                                    class="highcharts-point highcharts-color-1 "></rect>
                                <rect x="187" y="160" width="8" height="104" fill="#434348"
                                    class="highcharts-point highcharts-color-1 "></rect>
                                <rect x="265" y="166" width="8" height="98" fill="#434348"
                                    class="highcharts-point highcharts-color-1 "></rect>
                                <rect x="343" y="152" width="8" height="112" fill="#434348"
                                    class="highcharts-point highcharts-color-1 "></rect>
                                <rect x="422" y="175" width="8" height="89" fill="#434348"
                                    class="highcharts-point highcharts-color-1"></rect>
                                <rect x="500" y="154" width="8" height="110" fill="#434348"
                                    class="highcharts-point highcharts-color-1"></rect>
                                <rect x="579" y="154" width="8" height="110" fill="#434348"
                                    class="highcharts-point highcharts-color-1"></rect>
                                <rect x="657" y="168" width="8" height="96" fill="#434348"
                                    class="highcharts-point highcharts-color-1"></rect>
                                <rect x="736" y="176" width="8" height="88" fill="#434348"
                                    class="highcharts-point highcharts-color-1"></rect>
                                <rect x="814" y="152" width="8" height="112" fill="#434348"
                                    class="highcharts-point highcharts-color-1"></rect>
                                <rect x="892" y="167" width="8" height="97" fill="#434348"
                                    class="highcharts-point highcharts-color-1"></rect>
                            </g>
                            <g class="highcharts-markers highcharts-series-1 highcharts-column-series highcharts-color-1 "
                                transform="translate(69,63) scale(1 1)" clip-path="none"></g>
                            <g class="highcharts-series highcharts-series-2 highcharts-column-series highcharts-color-2  highcharts-tracker"
                                transform="translate(69,63) scale(1 1)" clip-path="url(#highcharts-pr1hfv0-10)">
                                <rect x="42" y="213" width="8" height="51" fill="#90ed7d"
                                    class="highcharts-point highcharts-color-2 "></rect>
                                <rect x="120" y="223" width="8" height="41" fill="#90ed7d"
                                    class="highcharts-point highcharts-color-2 "></rect>
                                <rect x="198" y="223" width="8" height="41" fill="#90ed7d"
                                    class="highcharts-point highcharts-color-2 "></rect>
                                <rect x="277" y="220" width="8" height="44" fill="#90ed7d"
                                    class="highcharts-point highcharts-color-2 "></rect>
                                <rect x="355" y="215" width="8" height="49" fill="#90ed7d"
                                    class="highcharts-point highcharts-color-2 "></rect>
                                <rect x="434" y="213" width="8" height="51" fill="#90ed7d"
                                    class="highcharts-point highcharts-color-2"></rect>
                                <rect x="512" y="202" width="8" height="62" fill="#90ed7d"
                                    class="highcharts-point highcharts-color-2"></rect>
                                <rect x="590" y="201" width="8" height="63" fill="#90ed7d"
                                    class="highcharts-point highcharts-color-2"></rect>
                                <rect x="669" y="209" width="8" height="55" fill="#90ed7d"
                                    class="highcharts-point highcharts-color-2"></rect>
                                <rect x="747" y="195" width="8" height="69" fill="#90ed7d"
                                    class="highcharts-point highcharts-color-2"></rect>
                                <rect x="826" y="202" width="8" height="62" fill="#90ed7d"
                                    class="highcharts-point highcharts-color-2"></rect>
                                <rect x="904" y="210" width="8" height="54" fill="#90ed7d"
                                    class="highcharts-point highcharts-color-2"></rect>
                            </g>
                            <g class="highcharts-markers highcharts-series-2 highcharts-column-series highcharts-color-2 "
                                transform="translate(69,63) scale(1 1)" clip-path="none"></g>
                            <g class="highcharts-series highcharts-series-3 highcharts-column-series highcharts-color-3  highcharts-tracker"
                                transform="translate(69,63) scale(1 1)" clip-path="url(#highcharts-pr1hfv0-10)">
                                <rect x="53" y="219" width="8" height="45" fill="#f7a35c"
                                    class="highcharts-point highcharts-color-3 "></rect>
                                <rect x="132" y="229" width="8" height="35" fill="#f7a35c"
                                    class="highcharts-point highcharts-color-3 "></rect>
                                <rect x="210" y="228" width="8" height="36" fill="#f7a35c"
                                    class="highcharts-point highcharts-color-3 "></rect>
                                <rect x="289" y="222" width="8" height="42" fill="#f7a35c"
                                    class="highcharts-point highcharts-color-3 "></rect>
                                <rect x="367" y="209" width="8" height="55" fill="#f7a35c"
                                    class="highcharts-point highcharts-color-3 "></rect>
                                <rect x="445" y="185" width="8" height="79" fill="#f7a35c"
                                    class="highcharts-point highcharts-color-3"></rect>
                                <rect x="524" y="204" width="8" height="60" fill="#f7a35c"
                                    class="highcharts-point highcharts-color-3"></rect>
                                <rect x="602" y="200" width="8" height="64" fill="#f7a35c"
                                    class="highcharts-point highcharts-color-3"></rect>
                                <rect x="681" y="214" width="8" height="50" fill="#f7a35c"
                                    class="highcharts-point highcharts-color-3"></rect>
                                <rect x="759" y="223" width="8" height="41" fill="#f7a35c"
                                    class="highcharts-point highcharts-color-3"></rect>
                                <rect x="837" y="215" width="8" height="49" fill="#f7a35c"
                                    class="highcharts-point highcharts-color-3"></rect>
                                <rect x="916" y="210" width="8" height="54" fill="#f7a35c"
                                    class="highcharts-point highcharts-color-3"></rect>
                            </g>
                            <g class="highcharts-markers highcharts-series-3 highcharts-column-series highcharts-color-3 "
                                transform="translate(69,63) scale(1 1)" clip-path="none"></g>
                        </g><text x="510" text-anchor="middle" class="highcharts-title"
                            style="color:#333333;font-size:18px;fill:#333333;" y="24">
                            <tspan>Monthly Average Rainfall</tspan>
                        </text><text x="510" text-anchor="middle" class="highcharts-subtitle"
                            style="color:#666666;fill:#666666;" y="46">
                            <tspan>Source: WorldClimate.com</tspan>
                        </text>
                        <g class="highcharts-legend" transform="translate(345,359)">
                            <rect fill="none" class="highcharts-legend-box" rx="0" ry="0" x="0" y="0"
                                width="330" height="26" visibility="visible"></rect>
                            <g>
                                <g>
                                    <g class="highcharts-legend-item highcharts-column-series highcharts-color-0 highcharts-series-0"
                                        transform="translate(8,3)"><text x="21"
                                            style="color:#333333;font-size:12px;font-weight:bold;cursor:pointer;fill:#333333;"
                                            text-anchor="start" y="15">
                                            <tspan>Tokyo</tspan>
                                        </text>
                                        <rect x="2" y="4" width="12" height="12" fill="#7cb5ec" rx="6"
                                            ry="6" class="highcharts-point"></rect>
                                    </g>
                                    <g class="highcharts-legend-item highcharts-column-series highcharts-color-1 highcharts-series-1"
                                        transform="translate(84.86249923706055,3)"><text x="21" y="15"
                                            style="color:#333333;font-size:12px;font-weight:bold;cursor:pointer;fill:#333333;"
                                            text-anchor="start">
                                            <tspan>New York</tspan>
                                        </text>
                                        <rect x="2" y="4" width="12" height="12" fill="#434348" rx="6"
                                            ry="6" class="highcharts-point"></rect>
                                    </g>
                                    <g class="highcharts-legend-item highcharts-column-series highcharts-color-2 highcharts-series-2"
                                        transform="translate(182.12703704833984,3)"><text x="21" y="15"
                                            style="color:#333333;font-size:12px;font-weight:bold;cursor:pointer;fill:#333333;"
                                            text-anchor="start">
                                            <tspan>London</tspan>
                                        </text>
                                        <rect x="2" y="4" width="12" height="12" fill="#90ed7d" rx="6"
                                            ry="6" class="highcharts-point"></rect>
                                    </g>
                                    <g class="highcharts-legend-item highcharts-column-series highcharts-color-3 highcharts-series-3"
                                        transform="translate(267.1395378112793,3)"><text x="21" y="15"
                                            style="color:#333333;font-size:12px;font-weight:bold;cursor:pointer;fill:#333333;"
                                            text-anchor="start">
                                            <tspan>Berlin</tspan>
                                        </text>
                                        <rect x="2" y="4" width="12" height="12" fill="#f7a35c" rx="6"
                                            ry="6" class="highcharts-point"></rect>
                                    </g>
                                </g>
                            </g>
                        </g>
                        <g class="highcharts-axis-labels highcharts-xaxis-labels "><text x="108.20833333333667"
                                style="color:#666666;cursor:default;font-size:11px;fill:#666666;" text-anchor="middle"
                                transform="translate(0,0)" y="345" opacity="1">Jan</text><text x="186.62499999999665"
                                style="color:#666666;cursor:default;font-size:11px;fill:#666666;" text-anchor="middle"
                                transform="translate(0,0)" y="345" opacity="1">Feb</text><text x="265.0416666666667"
                                style="color:#666666;cursor:default;font-size:11px;fill:#666666;" text-anchor="middle"
                                transform="translate(0,0)" y="345" opacity="1">Mar</text><text x="343.45833333333667"
                                style="color:#666666;cursor:default;font-size:11px;fill:#666666;" text-anchor="middle"
                                transform="translate(0,0)" y="345" opacity="1">Apr</text><text x="421.8749999999967"
                                style="color:#666666;cursor:default;font-size:11px;fill:#666666;" text-anchor="middle"
                                transform="translate(0,0)" y="345" opacity="1">May</text><text x="500.2916666666667"
                                style="color:#666666;cursor:default;font-size:11px;fill:#666666;" text-anchor="middle"
                                transform="translate(0,0)" y="345" opacity="1">Jun</text><text x="578.7083333333367"
                                style="color:#666666;cursor:default;font-size:11px;fill:#666666;" text-anchor="middle"
                                transform="translate(0,0)" y="345" opacity="1">Jul</text><text x="657.1249999999966"
                                style="color:#666666;cursor:default;font-size:11px;fill:#666666;" text-anchor="middle"
                                transform="translate(0,0)" y="345" opacity="1">Aug</text><text x="735.5416666666666"
                                style="color:#666666;cursor:default;font-size:11px;fill:#666666;" text-anchor="middle"
                                transform="translate(0,0)" y="345" opacity="1">Sep</text><text x="813.9583333333367"
                                style="color:#666666;cursor:default;font-size:11px;fill:#666666;" text-anchor="middle"
                                transform="translate(0,0)" y="345" opacity="1">Oct</text><text x="892.3749999999966"
                                style="color:#666666;cursor:default;font-size:11px;fill:#666666;" text-anchor="middle"
                                transform="translate(0,0)" y="345" opacity="1">Nov</text><text x="970.7916666666666"
                                style="color:#666666;cursor:default;font-size:11px;fill:#666666;" text-anchor="middle"
                                transform="translate(0,0)" y="345" opacity="1">Dec</text></g>
                        <g class="highcharts-axis-labels highcharts-yaxis-labels "><text x="54"
                                style="color:#666666;cursor:default;font-size:11px;fill:#666666;" text-anchor="end"
                                transform="translate(0,0)" y="331" opacity="1">0</text><text x="54"
                                style="color:#666666;cursor:default;font-size:11px;fill:#666666;" text-anchor="end"
                                transform="translate(0,0)" y="278" opacity="1">50</text><text x="54"
                                style="color:#666666;cursor:default;font-size:11px;fill:#666666;" text-anchor="end"
                                transform="translate(0,0)" y="225" opacity="1">100</text><text x="54"
                                style="color:#666666;cursor:default;font-size:11px;fill:#666666;" text-anchor="end"
                                transform="translate(0,0)" y="173" opacity="1">150</text><text x="54"
                                style="color:#666666;cursor:default;font-size:11px;fill:#666666;" text-anchor="end"
                                transform="translate(0,0)" y="120" opacity="1">200</text><text x="54"
                                style="color:#666666;cursor:default;font-size:11px;fill:#666666;" text-anchor="end"
                                transform="translate(0,0)" y="68" opacity="1">250</text></g><text x="1010"
                            class="highcharts-credits" text-anchor="end"
                            style="cursor:pointer;color:#999999;font-size:9px;fill:#999999;" y="395">Highcharts.com</text>
                        <g class="highcharts-label highcharts-tooltip highcharts-color-0"
                            style="cursor:default;pointer-events:none;white-space:nowrap;"
                            transform="translate(263,-9999)" opacity="0" visibility="visible">
                            <path fill="none" class="highcharts-label-box highcharts-tooltip-box"
                                d="M 3.5 0.5 L 133.5 0.5 C 136.5 0.5 136.5 0.5 136.5 3.5 L 136.5 105.5 C 136.5 108.5 136.5 108.5 133.5 108.5 L 3.5 108.5 C 0.5 108.5 0.5 108.5 0.5 105.5 L 0.5 3.5 C 0.5 0.5 0.5 0.5 3.5 0.5"
                                isShadow="true" stroke="#000000" stroke-opacity="0.049999999999999996" stroke-width="5"
                                transform="translate(1, 1)"></path>
                            <path fill="none" class="highcharts-label-box highcharts-tooltip-box"
                                d="M 3.5 0.5 L 133.5 0.5 C 136.5 0.5 136.5 0.5 136.5 3.5 L 136.5 105.5 C 136.5 108.5 136.5 108.5 133.5 108.5 L 3.5 108.5 C 0.5 108.5 0.5 108.5 0.5 105.5 L 0.5 3.5 C 0.5 0.5 0.5 0.5 3.5 0.5"
                                isShadow="true" stroke="#000000" stroke-opacity="0.09999999999999999" stroke-width="3"
                                transform="translate(1, 1)"></path>
                            <path fill="none" class="highcharts-label-box highcharts-tooltip-box"
                                d="M 3.5 0.5 L 133.5 0.5 C 136.5 0.5 136.5 0.5 136.5 3.5 L 136.5 105.5 C 136.5 108.5 136.5 108.5 133.5 108.5 L 3.5 108.5 C 0.5 108.5 0.5 108.5 0.5 105.5 L 0.5 3.5 C 0.5 0.5 0.5 0.5 3.5 0.5"
                                isShadow="true" stroke="#000000" stroke-opacity="0.15" stroke-width="1"
                                transform="translate(1, 1)"></path>
                            <path fill="rgba(247,247,247,0.85)" class="highcharts-label-box highcharts-tooltip-box"
                                d="M 3.5 0.5 L 133.5 0.5 C 136.5 0.5 136.5 0.5 136.5 3.5 L 136.5 105.5 C 136.5 108.5 136.5 108.5 133.5 108.5 L 3.5 108.5 C 0.5 108.5 0.5 108.5 0.5 105.5 L 0.5 3.5 C 0.5 0.5 0.5 0.5 3.5 0.5"
                                stroke="#7cb5ec" stroke-width="1"></path>
                        </g>
                    </svg>
                    <div class="highcharts-label highcharts-tooltip highcharts-color-0"
                        style="position: absolute; left: 263px; top: -9999px; opacity: 0; pointer-events: none; visibility: visible;">
                        <span transform="translate(0,0)"
                            style="font-family: &quot;Lucida Grande&quot;, &quot;Lucida Sans Unicode&quot;, Arial, Helvetica, sans-serif; font-size: 12px; position: absolute; white-space: nowrap; color: rgb(51, 51, 51); margin-left: 0px; margin-top: 0px; left: 8px; top: 8px;"><span
                                style="font-size:10px">May</span>
                            <table>
                                <tbody>
                                    <tr>
                                        <td style="color:#7cb5ec;padding:0">Tokyo: </td>
                                        <td style="padding:0"><b>144.0 mm</b></td>
                                    </tr>
                                    <tr>
                                        <td style="color:#434348;padding:0">New York: </td>
                                        <td style="padding:0"><b>106.0 mm</b></td>
                                    </tr>
                                    <tr>
                                        <td style="color:#90ed7d;padding:0">London: </td>
                                        <td style="padding:0"><b>47.0 mm</b></td>
                                    </tr>
                                    <tr>
                                        <td style="color:#f7a35c;padding:0">Berlin: </td>
                                        <td style="padding:0"><b>52.6 mm</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-wrap pd-20 mb-20 card-box">
            DeskApp - Bootstrap 4 Admin Template By
            <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
        </div>
    </div>
    <script>
        // Array bulan
        const months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        // Ambil bulan saat ini
        const currentDate = new Date();
        const currentMonth = currentDate.getMonth(); // Mendapatkan bulan saat ini (0 = Januari)
        const currentYear = currentDate.getFullYear(); // Mendapatkan tahun saat ini

        // Setel teks pada tombol dropdown menjadi bulan saat ini dan tahun ini
        document.getElementById('dropdownMenuButton').textContent = months[currentMonth] + ' ' + currentYear;

        // Tambahkan semua bulan ke dalam dropdown
        const monthDropdown = document.getElementById('monthDropdown');
        months.forEach((month, index) => {
            const dropdownItem = document.createElement('a');
            dropdownItem.className = 'dropdown-item';
            dropdownItem.href = '#';
            dropdownItem.textContent = month + ' ' + currentYear;
            monthDropdown.appendChild(dropdownItem);
        });
    </script>
@endsection
