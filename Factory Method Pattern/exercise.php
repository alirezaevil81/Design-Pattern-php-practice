<?php

interface Report
{
    public function export(array $data): string;
}

class PdfReport implements Report
{
    public function export(array $data): string
    {
        return "Exporting PDF with data: " . json_encode($data);
    }
}

class CsvReport implements Report
{
    public function export(array $data): string
    {
        return "Exporting CSV with data: " . implode(',', $data);
    }
}

class JsonReport implements Report
{
    public function export(array $data): string
    {
        return json_encode($data);
    }
}

abstract class ReportCreator
{
    // Factory Method
    abstract protected function createReport(): Report;

    // Template Method
    public function generate(array $data): string
    {
        $report = $this->createReport();

        // می‌توان اینجا منطق مشترک گذاشت
        return $report->export($data);
    }
}

class PdfReportCreator extends ReportCreator
{
    protected function createReport(): Report
    {
        return new PdfReport();
    }
}

class CsvReportCreator extends ReportCreator
{
    protected function createReport(): Report
    {
        return new CsvReport();
    }
}

class JsonReportCreator extends ReportCreator
{
    protected function createReport(): Report
    {
        return new JsonReport();
    }
}

$creator = new PdfReportCreator();
echo $creator->generate(['name' => 'Ali', 'score' => 95]);

$creator = new JsonReportCreator();
echo $creator->generate(['name' => 'Ali', 'score' => 95]);
