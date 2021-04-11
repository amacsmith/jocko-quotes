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

        $quote = $quotes->randomQuote();

        $this->assertIsString($quote);
    }

    /** @test */
    public function it_returns_a_quote_given_an_integer_index()
    {
        $quotes = new QuoteFactory();

        $quote = $quotes->quoteByInteger(1);

        $this->assertEquals("Just remember that you might not be wearing a cape, you might not have any magic powers, but you have the ultimate power and that is HUMAN WILL.", $quote);
    }

    /** @test */
    public function it_returns_the_quote_of_the_day()
    {
        $quotes = new QuoteFactory();

        $quote = $quotes->quoteOfTheDay();

        $this->assertIsString($quote);
    }
}