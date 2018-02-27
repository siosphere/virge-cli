<?php
namespace Virge\Cli\Component;

class Output
{
    /**
     * Text formatting options
     */
    const FORMAT_BOLD = [1, 21];
    const FORMAT_DIM = [2, 22];
    const FORMAT_UNDERLINE = [4, 24];
    const FORMAT_BLINK = [5, 25];
    const FORMAT_REVERSE = [7, 27];
    const FORMAT_HIDDEN = [8, 28];

    /**
     * Foreground colors
     */
     const FG_DEFAULT = 39;
     const FG_BLACK = 30;
     const FG_RED = 31;
     const FG_GREEN = 32;
     const FG_YELLOW = 33;
     const FG_BLUE = 34;
     const FG_MAGENTA = 35;
     const FG_CYAN = 36;
     const FG_LIGHT_GRAY = 37;
     const FG_DARK_GRAY = 90;
     const FG_LIGHT_RED = 91;
     const FG_LIGHT_GREEN = 92;
     const FG_LIGHT_YELLOW = 93;
     const FG_LIGHT_BLUE = 94;
     const FG_LIGHT_MAGENTA = 95;
     const FG_LIGHT_CYAN = 96;
     const FG_WHITE = 97;

     /**
      * Background colors
      */
    const BG_DEFAULT = 49;
    const BG_BLACK = 40;
    const BG_RED = 41;
    const BG_GREEN = 42;
    const BG_YELLOW = 43;
    const BG_BLUE = 44;
    const BG_MAGENTA = 45;
    const BG_CYAN = 46;
    const BG_LIGHT_GRAY = 47;
    const BG_DARK_GRAY = 100;
    const BG_LIGHT_RED = 101;
    const BG_LIGHT_GREEN = 102;
    const BG_LIGHT_YELLOW = 103;
    const BG_LIGHT_BLUE = 104;
    const BG_LIGHT_MAGENTA = 105;
    const BG_LIGHT_CYAN = 106;
    const BG_LIGHT_WHITE = 107;

    protected $stdOut;
    
    protected $stdErr;

    public function __construct()
    {
        $this->stdOut = fopen('php://stdout', 'w');
        $this->stdErr = fopen('php://stderr', 'w');
    }

    public function write(string $text)
    {
        $this->writeToStream($text, $this->stdOut);
    }

    public function success(string $text)
    {
        $this->write($this->decorate($text, self::FG_WHITE, self::BG_GREEN));
    }

    public function warning(string $text)
    {
        $this->write($this->decorate($text, self::FG_BLACK, self::BG_YELLOW));
    }

    public function error(string $text)
    {
        $this->writeToStream($this->decorate($text, self::FG_WHITE, self::BG_RED), $this->stdErr);
    }

    public function important(string $text)
    {
        $this->write($this->decorate($text, self::FG_LIGHT_MAGENTA, self::BG_DEFAULT));
    }

    public function highlight(string $text)
    {
        $this->write($this->decorate($text, self::FG_LIGHT_YELLOW, self::BG_DEFAULT));
    }

    protected function decorate($text, $fg = self::FG_DEFAULT, $bg = self::BG_DEFAULT)
    {
        $set = implode(';', [$fg, $bg]);
        $unset = implode(';', [self::FG_DEFAULT, self::BG_DEFAULT]);

        return sprintf("\033[%sm%s\033[%sm", $set, $text, $unset);
    }

    protected function writeToStream($text, $stream)
    {
        if(false === @fwrite($stream, $text)) {
            throw new RuntimeException("Failed to write output");
        }

        fflush($stream);
    }
}