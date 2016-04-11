<?php

class JamcoinSolver
{
    // Source: https://primes.utm.edu/lists/small/1000.txt
    private $primes = [2, 3, 5, 7, 11, 13, 17, 19, 23, 29,
 31, 37, 41, 43, 47, 53, 59, 61, 67, 71,
 73, 79, 83, 89, 97, 101, 103, 107, 109, 113,
 127, 131, 137, 139, 149, 151, 157, 163, 167, 173,
 179, 181, 191, 193, 197, 199, 211, 223, 227, 229,
 233, 239, 241, 251, 257, 263, 269, 271, 277, 281,
 283, 293, 307, 311, 313, 317, 331, 337, 347, 349,
 353, 359, 367, 373, 379, 383, 389, 397, 401, 409,
 419, 421, 431, 433, 439, 443, 449, 457, 461, 463,
 467, 479, 487, 491, 499, 503, 509, 521, 523, 541,
 547, 557, 563, 569, 571, 577, 587, 593, 599, 601,
 607, 613, 617, 619, 631, 641, 643, 647, 653, 659,
 661, 673, 677, 683, 691, 701, 709, 719, 727, 733,
 739, 743, 751, 757, 761, 769, 773, 787, 797, 809,
 811, 821, 823, 827, 829, 839, 853, 857, 859, 863,
 877, 881, 883, 887, 907, 911, 919, 929, 937, 941];

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

        list($jamcoinLength, $totalJamcoins) = explode(' ', $line);
        $jamcoinLength = (int) $jamcoinLength;
        $totalJamcoins = (int) $totalJamcoins;

        fputs(STDOUT, "Case #$caseNumber:\n");

        $start = base_convert(str_pad('1', $jamcoinLength - 1, '0', STR_PAD_RIGHT).'1', 2, 10);

        for ($i = $start; $totalJamcoins; $i++) {
            $jamcoin = base_convert($i, 10, 2);
            $divisors = [];

            if (!preg_match('/^1.*1$/', $jamcoin)) {
                continue;
            }

            for ($j = 2; $j < 11; $j++) {
                $number = base_convert($jamcoin, $j, 10);

                $jamcoinGmp = gmp_init($jamcoin, $j);
                $divisor = null;

                if (gmp_prob_prime($jamcoinGmp) == 0) {
                    foreach ($this->primes as $prime) {
                        if ($number % $prime == 0) {
                            $divisor = $prime;
                            break;
                        }
                    }
                }

                if (is_null($divisor)) {
                    $divisors = [];
                    break;
                }

                $divisors[] = $divisor;
            }

            if ($j == 11) {
                echo "$jamcoin ".implode(' ', $divisors)."\n";
                $totalJamcoins--;
            }
        }
    }

    private function getDivisor($number)
    {
        foreach ($this->primes as $prime) {
            if ($number % $prime == 0) {
                return $prime;
            }
        }

        return null;
    }
}
