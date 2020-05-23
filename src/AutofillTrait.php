<?php

trait AutofillTrait {
    abstract static function filterKey(): string;
    abstract static function autofillModels(): \Illuminate\Support\Collection;
}
