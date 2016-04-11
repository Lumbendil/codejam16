<?php

class SheepSolver
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

        $baseNumber = substr($line, 0, -1);
        $i = 0;

        $pendingNumbers = str_split('1234567890');

        if ($baseNumber == '0') {
            fputs(STDOUT, "Case #$caseNumber: INSOMNIA\n");
            return;
        }

        while ($pendingNumbers) {
            $i++;
            $result = bcmul($baseNumber, $i);
            $this->removeUniqueNumbers($pendingNumbers, $result);
            // echo "Iteration $i: CurrentNumber $result. Pending numbers".implode($pendingNumbers).PHP_EOL;
        }

        fputs(STDOUT, "Case #$caseNumber: $result\n");
    }

    private function removeUniqueNumbers(array &$pendingNumbers, $number)
    {
        $pendingNumbers = array_diff($pendingNumbers, array_unique(str_split($number)));
    }
}
