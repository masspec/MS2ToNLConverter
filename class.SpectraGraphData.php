<?php

class SpectraGraphData {

    private $chartType;
    private $title;
    private $subtitle;
    private $credits;

    private $xAxisTitleText;
    private $xAxisCrosshair;
    private $xAxisMin;
    private $xAxisMax;

    private $yAxisTitle;
    private $yAxisMin;
    private $yAxisMax;

    private $tooltipHeaderFormat;
    private $tooltipPointFormat;
    private $tooltipFooterFormat;
    private $tooltipShared;
    private $tooltipUseHTML;

    private $plotOptionsSeriesPointWidth;
    private $plotOptionsColumnPointPadding;
    private $plotOptionsColumnBorderWidth;
    private $plotOptionsColumnStacking;

    private $seriesName;
    private $seriesBorderWidth;
    private $seriesStacked;
    private $seriesData;

    function __construct($chartType = null, $title = null, $subtitle = null, $credits = null) {
        $this->chartType = $chartType;
        $this->title     = $title;
        $this->subtitle  = $subtitle;
        $this->credits   = $credits;
    }

    function __destruct() {
    }

    #
    # Setters
    #

    function setChartType($val) {
        $this->chartType = $val;
    }

    function setTitle($val) {
        $this->title = $val;
    }

    function setSubtitle($val) {
        $this->subtitle = $val;
    }

    function setCredits($val) {
        $this->credits = $val;
    }

    function setXAxisTitle($val) {
        $this->xAxisTitle = $val;
    }

    function setXAxisMin($val) {
        $this->xAxisMin = $val;
    }

    function setXAxisMax($val) {
        $this->xAxisMax = $val;
    }

    function setXAxisCrosshair($val) {
        $this->xAxisCrosshair = $val;
    }

    function setYAxisTitle($val) {
        $this->yAxisTitle = $val;
    }

    function setYAxisMin($val) {
        $this->yAxisMin = $val;
    }

    function setYAxisMax($val) {
        $this->yAxisMax = $val;
    }

    function setTooltipHeaderFormat($val) {
        $this->tooltipHeaderFormat = $val;
    }

    function setPointFormat($val) {
        $this->pointFormat = $val;
    }

    function setTooltipFooterFormat($val) {
        $this->tooltipFooterFormat = $val;
    }

    function setTooltipShared($val) {
        $this->tooltipShared = $val;
    }

    function setTooltipUseHTML($val) {
        $this->tooltipUseHTML = $val;
    }

    function setPlotOptionsSeriesPointWidth($val) {
        $this->plotOptionsSeriesPointWidth = $val;
    }

    function setPlotOptionsColumnPointPadding($val) {
        $this->plotOptionsColumnPointPadding = $val;
    }

    function setPlotOptionsColumnBorderWidth($val) {
        $this->plotOptionsColumnBorderWidth = $val;
    }

    function setPlotOptionsColumnStacking($val) {
        $this->plotOptionsColumnStacking = $val;
    }

    function setSeries($name, $id, $dataArray) {
        $this->series[] = array("name" => $name, "id" => $id, "data" => $dataArray);
    }


    #
    # Getters
    #

    function getChartType() {
        return $this->chartType;
    }

    function getTitle() {
        return $this->title;
    }

    function getSubtitle() {
        return $this->subtitle;
    }

    function getCredits() {
        return $this->credits;
    }

    function getXAxisTitle() {
        return $this->xAxisTitle;
    }

    function getXAxisCrosshair() {
        return $this->xAxisCrosshair;
    }

    function getXAxisMin() {
        return $this->xAxisMin;
    }

    function getXAxisMax() {
        return ($this->xAxisMax);
    }

    function getYAxisTitle() {
        return $this->yAxisTitle;
    }

    function getYAxisMin() {
        return $this->yAxisMin;
    }
    function getYAxisMax() {
        return $this->yAxisMax;
    }

    function getTooltipHeaderFormat() {
        return $this->tooltipHeaderFormat;
    }

    function getPointFormat() {
        return $this->pointFormat;
    }

    function getTooltipFooterFormat() {
        return $this->tooltipFooterFormat;
    }

    function getTooltipShared() {
        return $this->tooltipShared;
    }

    function getTooltipUseHTML() {
        return $this->tooltipUseHTML;
    }

    function getPlotOptionsSeriesPointWidth() {
        return $this->plotOptionsSeriesPointWidth;
    }

    function getPlotOptionsColumnPointPadding() {
        return $this->plotOptionsColumnPointPadding;
    }

    function getPlotOptionsColumnBorderWidth() {
        return $this->plotOptionsColumnBorderWidth;
    }

    function getPlotOptionsColumnStacking() {
        return $this->plotOptionsColumnStacking;
    }

    function getSeries() {
        return $this->series;
    }

    function getYAxis() {
        $yAxis["yAxis"] = array(array("opposite" => false, "lineWidth" => 2, "startOnTick" => true, "endOnTick" => true, "showLastLabel" => true, "tickPixelInterval" => 40, "minPadding" => 0, "maxPadding" => 0, "minRange" => 1, "labels" => array("align" => "right", "x" => -5, "y" => 3, "style" => array("fontSize" => "10px")), "softMin" => 0, "softMax" => 100, "gridLineWidth" => 0, "minorGridLineWidth" => 0), array("opposite" => true, "lineWidth" => 2, "startOnTick" => true, "endOnTick" => true, "showLastLabel" => true, "tickPixelInterval" => 40, "minPadding" => 0, "maxPadding" => 0, "minRange" => 1, "labels" => array("align" => "left", "x" => 5, "y" => 3, "style" => array("fontSize" => "10px")), "softMin" => 0, "softMax" => 100, "gridLineWidth" => 0, "minorGridLineWidth" => 0));
        return $yAxis;
    }


    function getResponsive() {


        $rules["rules"] = array(
                                array("condition" => array("maxWidth" => 500),
                                      "chartOptions" => array("legend" => array("align" => "center", "verticalAlign" => "bottom", "layout" => "horizontal"),
                                                              "yAxis" => array("labels" => array("align" => "left", "x" => 5, "y" => -5),
                                                                               "title" => array("text" => null)),
                                                              "subtitle" => array("text" => null),
                                                              "credits" => array("enabled" => false))
                                     ));

        $responsive["responsive"] = array_merge($rules);
        return $responsive;
    }


    function getJSON() {
        $subtitle["subtitle"] = array("text" => $this->getSubtitle());
        $xAxis["xAxis"]       = array("max" => $this->getXAxisMax());
        $series["series"]     = $this->getSeries();
        $final                = array_merge($series, $xAxis, $subtitle);

        return json_encode($final);
    }
}

?>


