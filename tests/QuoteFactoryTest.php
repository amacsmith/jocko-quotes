<?php


namespace AMacSmith\JockoQuotes\Tests;

use AMacSmith\JockoQuotes\QuoteFactory;
use PHPUnit\Framework\TestCase;

class QuoteFactoryTest extends TestCase
{
    /** @test */
    public function it_returns_a_random_quote()
    {
        $quotes = new QuoteFactory();

        $quote = $quotes->getRandomQuote();

        $this->assertIsString($quote);
    }

    /** @test */
    public function it_returns_a_quote_given_an_integer_index()
    {
        $quotes = new QuoteFactory();

        $quote = $quotes->getQuoteByInteger(1);

        $this->assertEquals("I'm honored that I had the privilege to go and fight for America. — Thom \"DRAGO\" Dzieran", $quote);
    }
}