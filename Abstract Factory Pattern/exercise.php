<?php

interface Button {
    public function render() : string ;
}


interface Checkbox {
    public function render() : string ;
}

class WindowsButton implements Button {
    public function render(): string
    {
        return "windows style button";
    }
}

class MacOSButton implements Button {
    public function render(): string
    {
        return "macOS style button";
    }
}

class WindowsCheckBox implements Checkbox {
    public function render(): string
    {
        return "windows style checkbox";
    }
}


class MacOSCheckBox implements Checkbox {
    public function render(): string
    {
        return "macOS style checkbox";
    }
}


interface UIFactory {
    public function createButton() : Button ;
    public function createCheckbox() : Checkbox;
}

class WindowsUIFactory implements UIFactory {
    public function createButton() : Button {
        return new WindowsButton();
    }
    public function createCheckbox() : Checkbox {
        return new WindowsCheckBox();
    }
}

class MacOSUIFactory implements UIFactory {
    public function createButton(): Button {
        return new MacOSButton();
    }
    public function createCheckbox() : Checkbox {
        return new MacOSCheckBox();
    }
}

function createUI(UIFactory $factory): string {
    $button = $factory->createButton();
    $checkbox = $factory->createCheckbox();
    return $button->render() . $checkbox->render();
}

echo createUI(new WindowsUIFactory());
echo createUI(new MacOSUIFactory());