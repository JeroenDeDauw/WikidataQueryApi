<?php

namespace WikidataQueryApi\Services;

use Serializers\Serializer;
use Wikibase\DataModel\Entity\ItemId;
use WikidataQueryApi\DataModel\AbstractQuery;
use WikidataQueryApi\WikibaseQueryApiException;
use WikidataQueryApi\WikidataQueryApi;

/**
 * Simple service that returns a list of ItemId for a given query.
 *
 * @licence GPLv2+
 * @author Thomas Pellissier Tanon
 */
class SimpleQueryService {

	/**
	 * @var WikidataQueryApi
	 */
	private $api;

	/**
	 * @var Serializer
	 */
	private $querySerializer;

	/**
	 * @param WikidataQueryApi $api
	 * @param Serializer $querySerializer
	 */
	public function __construct( WikidataQueryApi $api, Serializer $querySerializer ) {
		$this->api = $api;
		$this->querySerializer = $querySerializer;
	}

	/**
	 * @param AbstractQuery $query
	 * @return ItemId[]
	 *
	 * @throws WikibaseQueryApiException
	 */
	public function doQuery( AbstractQuery $query ) {
		$result = $this->api->doQuery( array(
			'q' => $this->querySerializer->serialize( $query )
		) );

		return $this->parseItemList( $result['items'] );
	}

	private function parseItemList( array $itemNumericIds ) {
		$list = array();

		foreach ( $itemNumericIds as $itemNumericId ) {
			$list[] = new ItemId( 'Q' . $itemNumericId );
		}

		return $list;
	}
}
