<?php
class PasswordGenerator {
    public function generate($length, $upper, $lower, $numbers, $special) {
        $upperChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $lowerChars = 'abcdefghijklmnopqrstuvwxyz';
        $numberChars = '0123456789';
        $specialChars = '!@#$%^&*()_+-=[]{}';

        $result = '';

        // randomly pick characters
        $result .= $this->getRandom($upperChars, $upper);
        $result .= $this->getRandom($lowerChars, $lower);
        $result .= $this->getRandom($numberChars, $numbers);
        $result .= $this->getRandom($specialChars, $special);

        // fill remaining length with random mix
        $remaining = $length - strlen($result);
        $allChars = $upperChars . $lowerChars . $numberChars . $specialChars;
        $result .= $this->getRandom($allChars, $remaining);

        // shuffle final password
        return str_shuffle($result);
    }

    private function getRandom($characters, $count) {
        $output = '';
        $len = strlen($characters);
        for ($i = 0; $i < $count; $i++) {
            $output .= $characters[rand(0, $len - 1)];
        }
        return $output;
    }
}
