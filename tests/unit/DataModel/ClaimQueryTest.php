<?php

namespace PPP\DataModel;

use Wikibase\DataModel\Entity\ItemId;
use Wikibase\DataModel\Entity\PropertyId;
use WikidataQueryApi\DataModel\ClaimQuery;

/**
 * @covers PPP\DataModel\Serializers\ClaimQuerySerializer
 *
 * @licence MIT
 * @author Thomas Pellissier Tanon
 */
class ClaimQueryTest extends \PHPUnit_Framework_TestCase {

	public function testGetPropertyId() {
		$query = new ClaimQuery( new PropertyId( 'P42' ), new ItemId( 'Q42' ) );
		$this->assertEquals( new PropertyId( 'P42' ), $query->getPropertyId() );
	}

	public function testGetItemId() {
		$query = new ClaimQuery( new PropertyId( 'P42' ), new ItemId( 'Q42' ) );
		$this->assertEquals( new ItemId( 'Q42' ), $query->getItemId() );
	}

	public function testGetType() {
		$query = new ClaimQuery( new PropertyId( 'P42' ) );
		$this->assertEquals( 'claim', $query->getType() );
	}
}