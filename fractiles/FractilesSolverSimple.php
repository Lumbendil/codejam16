<?php

class FractilesSolverSimple
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
        $line = fgets(STDIN);

        list($sequenceLength, $complexity, $students) = explode(' ', $line);

        $sequenceLength = (int) $sequenceLength;
        $complexity = (int) $complexity;
        $students = (int) $students;

        $solution = [];

        for ($i = 1; $i <= $students; $i++) {
            $solution[] = $i;
        }

        fputs(STDOUT, "Case #$caseNumber: ".implode(' ', $solution).PHP_EOL);
    }
}
