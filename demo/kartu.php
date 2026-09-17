<?php
interface TapPayment {
    public function getAccountID(): int;
    public function getBalance(): float;
    public function pay(float $amount): bool;
}

// Interface EWallet mewarisi TapPayment
interface EWallet extends TapPayment {
    public function topUp(float $amount): void;
    public function getSaldoEWallet(): float;
    public function useEWallet(float $amount): bool;
}

interface VisaCard {
    public function getCardNumber(): string;
    public function getSisaCredit(): float;
    public function charge(float $amount, int $cvv): bool;
}

// Class SilverCard mengimplementasikan interface visacard
class SilverCard implements VisaCard {
    private string $cardNumber;
    private float $limitCredit;
    private int $cvv;

    public function __construct(string $cardNumber, float $limitCredit, int $cvv) {
        $this->cardNumber = $cardNumber;
        $this->limitCredit = $limitCredit;
        $this->cvv = $cvv;
    }

    public function getCardNumber(): string {
        return $this->cardNumber;
    }

    public function getSisaCredit(): float {
        return $this->limitCredit;
    }

    public function charge(float $amount, int $cvv): bool {
        if ($this->cvv !== $cvv) {
            echo "CVV Salah!<br>";
            return false;
        }
        if ($this->limitCredit >= $amount) {
            $this->limitCredit -= $amount;
            echo "Charged {$amount} to card {$this->cardNumber}. Sisa credit: {$this->limitCredit}<br>";
            return true;
        }
        return false;
    }
}

class GoldCard implements VisaCard, TapPayment, EWallet {
    private string $cardNumber;
    private float $limitCredit;
    private int $cvv;
    private int $accountID;
    private float $saldoEWallet;

    public function __construct(string $cardNumber, float $limitCredit, int $cvv, int $accountID, float $saldoEWallet) {
        $this->cardNumber = $cardNumber;
        $this->limitCredit = $limitCredit;
        $this->cvv = $cvv;
        $this->accountID = $accountID;
        $this->saldoEWallet = $saldoEWallet;
    }

    // Method dari interface VisaCard
    public function getCardNumber(): string {
        return $this->cardNumber;
    }

    public function getSisaCredit(): float {
        return $this->limitCredit;
    }

    public function charge(float $amount, int $cvv): bool {
        if ($this->cvv !== $cvv) {
            echo "CVV Salah!<br>";
            return false;
        }
        if ($this->limitCredit >= $amount) {
            $this->limitCredit -= $amount;
            echo "Charged {$amount} to card {$this->cardNumber}. Sisa credit: {$this->limitCredit}<br>";
            return true;
        }
        return false;
    }

    // Method dari interface TapPayment
    public function getAccountID(): int {
        return $this->accountID;
    }

    public function getBalance(): float {
        return $this->saldoEWallet;
    }

    public function pay(float $amount): bool {
        if ($this->saldoEWallet >= $amount) {
            $this->saldoEWallet -= $amount;
            echo "Paid {$amount} from account {$this->accountID}. Sisa balance: {$this->saldoEWallet}<br>";
            return true;
        }
        return false;
    }

    // Method dari interface EWallet
    public function topUp(float $amount): void {
        $this->saldoEWallet += $amount;
        echo "Top up {$amount} to e-wallet. Saldo: {$this->saldoEWallet}<br>";
    }

    public function getSaldoEWallet(): float {
        return $this->saldoEWallet;
    }

    public function useEWallet(float $amount): bool {
        if ($this->saldoEWallet >= $amount) {
            $this->saldoEWallet -= $amount;
            echo "Used {$amount} from e-wallet. Sisa saldo: {$this->saldoEWallet}<br>";
            return true;
        }
        return false;
    }
}