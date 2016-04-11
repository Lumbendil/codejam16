<?php

class PancakeSolver
{
    public function solve()
    {
        $line = fgets(STDIN);

        $numCases = (int) $line;

        for ($i = 1; $i <= $numCases; ++$i) {
            $this->solveCase($i);
        }
    }

    private function solveCase($caseNumber)
    {
        $pancakes = fgets(STDIN);
        $pancakes = substr($pancakes, 0, -1);

        $i = 0;

        while (strpos($pancakes, '-') !== false) {
            $i++;

            // Remove all pancakes properly placed in the bottom
            $pancakes = preg_replace('/\+*$/', '', $pancakes);

            // All are back side up, so this is the last iteration.
            if (strrpos($pancakes, '+') === false) {
                break;
            }

            $firstBacksidePancake = strpos($pancakes, '-');

            if ($firstBacksidePancake == 0) {
                $pancakes = $this->reversePancakes($pancakes, strlen($pancakes));
            } else {
                $pancakes = $this->reversePancakes($pancakes, $firstBacksidePancake);
            }
        }

        fputs(STDOUT, "Case #$caseNumber: $i\n");
    }

    private function reversePancakes($pancakes, $offset)
    {
        $turnedPancakes = substr($pancakes, 0, $offset);
        $turnedPancakes = strtr($turnedPancakes, '+-', '-+');
        $turnedPancakes = strrev($turnedPancakes);

        return $turnedPancakes.substr($pancakes, $offset);
    }
}
