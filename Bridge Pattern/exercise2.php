<?php

interface Theme
{
    public function getBackgroundColor(): string;

    public function getTextColor(): string;
}


class LightTheme implements Theme
{
    public function getBackgroundColor(): string
    {
        return "#FFFFFF";
    }

    public function getTextColor(): string
    {
        return "#000000";
    }
}

class DarkTheme implements Theme
{
    public function getBackgroundColor(): string
    {
        return "#1E1E1E";
    }

    public function getTextColor(): string
    {
        return "#FFFFFF";
    }
}

interface WebPage
{
    public function getContent(): string;
}

abstract class AbstractWebPage implements WebPage
{
    protected Theme $theme;

    public function __construct(Theme $theme)
    {
        $this->theme = $theme;
    }

    public function setTheme(Theme $theme)
    {
        $this->theme = $theme;
    }

    public function getBackgroundColor(): string
    {
        return $this->theme->getBackgroundColor();
    }

    public function getTextColor(): string
    {
        return $this->theme->getTextColor();
    }

    abstract public function getContent(): string;
}

class HomePage extends AbstractWebPage
{
    public function getContent(): string
    {
        return "<div style='background-color: {$this->getBackgroundColor()}; color: {$this->getTextColor()};'>Welcome to our website!</div>";
    }
}

class AboutPage extends AbstractWebPage
{
    public function getContent(): string
    {
        return "<div style='background-color: {$this->getBackgroundColor()}; color: {$this->getTextColor()};'>Learn more about us...</div>";
    }
}

// Usage example
$lightTheme = new LightTheme();
$darkTheme = new DarkTheme();

$homePage = new HomePage($lightTheme);
echo $homePage->getContent() . "<br>";

$homePage->setTheme($darkTheme);
echo $homePage->getContent() . "<br>";

$aboutPage = new AboutPage($darkTheme);
echo $aboutPage->getContent() . "<br>";
