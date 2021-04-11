<?php


namespace AMacSmith\JockoQuotes;

use Exception;
use GuzzleHttp\Client;
use RuntimeException;

class QuoteFactory
{
    const QUOTE_API_ENDPOINT = 'https://www.jqdb.org/quotes?q=';
    const QUOTE_COUNT_API_ENDPOINT = 'https://www.jqdb.org/quotes?q=COUNT';

    /**
     * @var Client
     */
    private $client;

    /**
     * JokeFactory constructor.
     * @param Client $client
     */
    public function __construct(Client $client = null)
    {
        $this->client = $client ?: new Client();
    }

    public function getQuoteCount()
    {
        $response = $this->client->get(self::QUOTE_COUNT_API_ENDPOINT);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getRandomQuote()
    {
        $quoteCount = $this->getQuoteCount();
        $randomQuoteIndex = mt_rand(0, $quoteCount);

        $response = $this->client->get(self::QUOTE_API_ENDPOINT . "-$randomQuoteIndex");

        return json_decode($response->getBody()->getContents())[0]->q;
    }

    public function getQuoteByInteger(int $quoteIndex)
    {
        $quoteCount = $this->getQuoteCount();

        if($quoteIndex < 0 || $quoteIndex > $quoteCount) {
            throw new RuntimeException('The Quote Index passed is not within the valid Quote Index Range 0 to ' . $quoteCount);
        }

        $quoteIndexString = "-{$quoteIndex}";

        $response = $this->client->get(self::QUOTE_API_ENDPOINT . $quoteIndexString);

        return json_decode($response->getBody()->getContents())[0]->q;
    }
}