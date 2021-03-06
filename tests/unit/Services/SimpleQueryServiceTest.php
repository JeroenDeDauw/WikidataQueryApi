<?php

namespace WikidataQueryApi\Services;
use Wikibase\DataModel\Entity\ItemId;
use Wikibase\DataModel\Entity\PropertyId;
use WikidataQueryApi\DataModel\ClaimQuery;
use WikidataQueryApi\DataModel\Serializers\ClaimQuerySerializer;

/**
 * @covers WikidataQueryApi\Services\SimpleQueryService
 *
 * @licence GPLv2+
 * @author Thomas Pellissier Tanon
 */
class SimpleQueryServiceTest extends \PHPUnit_Framework_TestCase {

	public function testDoQuery() {
		$apiMock = $this->getMockBuilder( 'WikidataQueryApi\WikidataQueryApi' )
			->disableOriginalConstructor()
			->getMock();
		$apiMock->expects( $this->any() )
			->method( 'doQuery' )
			->with( $this->equalTo( array(
				'q' => 'claim[42:42]'
			) ) )
			->will( $this->returnValue( array(
				'status' => array( 'error' => 'OK' ),
				'items' => array( 42 )
			) ) );

		$service = new SimpleQueryService( $apiMock, new ClaimQuerySerializer() );
		$this->assertEquals(
			array(
				new ItemId( 'Q42' )
			),
			$service->doQuery(
				new ClaimQuery( new PropertyId('P42'), new ItemId( 'Q42' ) )
			)
		);
	}
}
