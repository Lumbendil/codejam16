<?php

class FractilesSolver
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

        // fputs(STDOUT, "Case #$caseNumber:\n");

        $tilesetLength = $sequenceLength^$complexity;

        $potentialTilesets = $this->obtainTilesets($sequenceLength, $complexity);
    }

    private function obtainTilesets($sequenceLength, $complexity)
    {
        $tilesets = [];

        $permutations = $this->obtainPermutations($sequenceLength);

        foreach ($permutations as $permutation) {
            if (preg_match('/^G+$/', $permutation) || preg_match('/^L+$/', $permutation)) {
                continue;
            }

            $tilesets[] = $this->obtainFinalTileset($permutation, $complexity);
        }

        return $tilesets;
    }

    private function obtainPermutations($length)
    {
        $permutations = ['L', 'G'];

        for ($i = 1; $i < $length; $i++) {
            $newPermutations = [];

            foreach ($permutations as $permutation) {
                $newPermutations[] = $permutation.'L';
                $newPermutations[] = $permutation.'G';
            }

            $permutations = $newPermutations;
        }

        return $permutations;
    }

    private function obtainFinalTileset($baseTile, $complexity)
    {
        $baseTileLength = strlen($baseTile);
        $result = $baseTile;
        for ($i = 1; $i < $complexity; $i++) {
            $newResult = '';
            for ($j = 0, $end = strlen($result); $j < $end; $j++) {
                if ($result[$j] == 'L') {
                    $newResult .= $baseTile;
                } else {
                    $newResult .= str_repeat('G', $baseTileLength);
                }
            }

            $result = $newResult;
        }

        return $result;
    }
}
