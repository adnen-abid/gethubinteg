<?php $array = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
  <soap:Body>
    <BookFlightsResponse xmlns="ElsyArres.API">
      <SoapMessage>
        <Username>EgyptspiritAPI</Username>
        <Password>0555B8836C</Password>
        <LanguageCode>EN</LanguageCode>
        <ErrorMessage>Flight not confirmed by carrier [130328084646-30-6936-7279]</ErrorMessage>
        <ErrorCode>6000</ErrorCode>
        <AppVersion>8.0.2</AppVersion>
        <Request>
          <FlightId>130328084646-30-6936-7279</FlightId>
          <ConfirmNewPrice>true</ConfirmNewPrice>
          <ClientIP />
          <CustomContainer />
        </Request>
        <Response>
          <Booked>true</Booked>
          <ClientIP>123.201.254.254</ClientIP>
          <CurrencyCode>GBP</CurrencyCode>
          <CustomerInfo>
            <CustomerId />
            <Sex>MALE</Sex>
            <FirstName>FirstnameA</FirstName>
            <LastName>LastNameA</LastName>
            <CompanyName>Test Company Ltd</CompanyName>
            <Street>Test Street</Street>
            <HouseNo>111</HouseNo>
            <Zip>12345</Zip>
            <City>Test City</City>
            <CountryCode>DE</CountryCode>
            <PhoneCountry>1</PhoneCountry>
            <PhoneArea>234</PhoneArea>
            <PhoneNumber>567890</PhoneNumber>
            <MobileCountry />
            <MobileArea />
            <MobileNumber />
            <Email>w.ashour@egyptspirit.co.uk</Email>
          </CustomerInfo>
          <PassengerInfo>
            <Passenger>
              <Type>ADULT</Type>
              <Sex>MALE</Sex>
              <FirstName>FirstnameA</FirstName>
              <LastName>LastNameA</LastName>
              <Birthday>1983-01-22</Birthday>
              <BaggageCode>0/0</BaggageCode>
              <PassportNumber />
            </Passenger>
          </PassengerInfo>
          <PaymentInfo>
            <PaymentCode>VISA</PaymentCode>
            <Holder>TEST</Holder>
            <Number>************1111</Number>
            <CVC>***</CVC>
            <Expiry>03/21</Expiry>
            <BankName />
            <BankCode />
            <BillingAddress>
              <Street>bangalore</Street>
              <HouseNo>111</HouseNo>
              <Zip>12345</Zip>
              <City>bangalore</City>
              <CountryCode>DE</CountryCode>
            </BillingAddress>
          </PaymentInfo>
          <FlightDetails>
            <MinSinglePaxAge>16</MinSinglePaxAge>
            <Provider>ElsyArres</Provider>
            <CC3DSecure>false</CC3DSecure>
            <CCRequiredForCheckIn>true</CCRequiredForCheckIn>
            <PassportNoRequired>false</PassportNoRequired>
            <PassportDetailsRequired>false</PassportDetailsRequired>
            <RealRoundtrip>false</RealRoundtrip>
            <Roundtrip>false</Roundtrip>
            <TotalFare>5430</TotalFare>
            <CCExpiryDate>2013-04-01T00:00:00</CCExpiryDate>
            <Outbound>
              <CarName>Test Airline</CarName>
              <CarCode>_2</CarCode>
              <DepName>Test Aalborg (AAL)</DepName>
              <DepCode>AAL</DepCode>
              <DestName>Test Arrecife (Lanzarote) (ACE)</DestName>
              <DestCode>ACE</DestCode>
              <Duration>02:20</Duration>
              <FlightNo>_20000</FlightNo>
              <DepDateTime>2013-04-24T23:15:00</DepDateTime>
              <ArrDateTime>2013-04-25T00:35:00</ArrDateTime>
              <Legs>
                <Leg>
                  <Sequence>0</Sequence>
                  <FlightNo>??0000</FlightNo>
                  <DepCode>AAL</DepCode>
                  <DepName>Aalborg</DepName>
                  <DestCode>ACE</DestCode>
                  <DestName>Arrecife (Lanzarote)</DestName>
                  <DepTime>23:15</DepTime>
                  <ArrTime>00:35</ArrTime>
                  <CarCode>??</CarCode>
                  <CarName>??</CarName>
                  <FareClass>Economy</FareClass>
                  <ArrDateTime>2013-04-25T00:35:00</ArrDateTime>
                  <DepDateTime>2013-04-24T23:15:00</DepDateTime>
                </Leg>
              </Legs>
              <Taxes>2862</Taxes>
              <FareADT>2146</FareADT>
              <FareCHD>0</FareCHD>
              <FareINF>0</FareINF>
              <MiscFees>0</MiscFees>
              <Idx>0</Idx>
              <FareClass>Economy</FareClass>
              <FareType>Web</FareType>
              <FareId>_20</FareId>
              <FareInfo>
                <string>Luggage can not be booked online. Please book the needed baggage at the airport check-in.</string>
              </FareInfo>
              <TotalFare>5430</TotalFare>
              <TermsUrl>http://testv80.elsyarres.net/terms.aspx?tid=Y/TER/140/3&amp;amp;cid=N/CAR/3224/2&amp;amp;lang=EN</TermsUrl>
              <BillingAmount>6407</BillingAmount>
              <BillingCurrency>EUR</BillingCurrency>
            </Outbound>
            <BookingOptions>
              <BookingOption>
                <OptionCode>SpeedBoarding</OptionCode>
                <Fee>341</Fee>
              </BookingOption>
            </BookingOptions>
            <PaymentOptions>
              <PaymentOption>
                <PaymentCode>DIRECTEBANKING</PaymentCode>
                <Fee>422</Fee>
              </PaymentOption>
              <PaymentOption>
                <PaymentCode>MASTERCARD</PaymentCode>
                <Fee>251</Fee>
              </PaymentOption>
              <PaymentOption>
                <PaymentCode>VISA</PaymentCode>
                <Fee>422</Fee>
              </PaymentOption>
            </PaymentOptions>
            <BaggageOptions>
              <BaggageOption>
                <BaggageCode>0/0</BaggageCode>
                <Pcs>0</Pcs>
                <Fee>0</Fee>
                <Weight>0</Weight>
              </BaggageOption>
            </BaggageOptions>
          </FlightDetails>
          <BillingInfo>
            <HandlingFeePaid>0</HandlingFeePaid>
            <PremiumTIPaid>0</PremiumTIPaid>
            <PremiumCIPaid>0</PremiumCIPaid>
            <TotalDuePaid>5430</TotalDuePaid>
            <TransactionFeePaid>0</TransactionFeePaid>
            <PolicyId />
            <CurrencyCode>GBP</CurrencyCode>
            <PaymentId>Y/PAY/1303280234480/00847272</PaymentId>
            <PaymentStatus>0</PaymentStatus>
            <PaymentScore>0</PaymentScore>
          </BillingInfo>
          <BookFlightsResult>
            <Outbound>
              <CreditCardNumber />
              <LoginUrl>http://www.google.co.uk</LoginUrl>
              <LoginUsername>Y46966t8yzabcde</LoginUsername>
              <LoginPassword>Y9x46966</LoginPassword>
              <BookingCode>PENDING</BookingCode>
              <BookingErrorMsg>700 - unexpected error</BookingErrorMsg>
              <BookingStatus>Pending</BookingStatus>
              <BillingAmount>0</BillingAmount>
              <BillingCurrency>EUR</BillingCurrency>
            </Outbound>
          </BookFlightsResult>
          <SearchFlightParams>
            <Departure>AAL</Departure>
            <Destination>ACE</Destination>
            <DepartureDate>2013-04-24</DepartureDate>
            <ReturnDate />
            <LanguageCode>XX</LanguageCode>
            <NumADT>1</NumADT>
            <NumINF>0</NumINF>
            <NumCHD>0</NumCHD>
            <CurrencyCode>GBP</CurrencyCode>
            <NearbyDepartures>false</NearbyDepartures>
            <NearbyDestinations>false</NearbyDestinations>
            <RROnly>false</RROnly>
            <CarrierList>
              <string>N/CAR/3224/2</string>
            </CarrierList>
            <FareClasses />
            <Providers />
          </SearchFlightParams>
          <RetryPossible>false</RetryPossible>
          <ConfirmedCurrency>GBP</ConfirmedCurrency>
          <ConfirmedPrice>5430</ConfirmedPrice>
          <BookingOptions />
        </Response>
      </SoapMessage>
    </BookFlightsResponse>
  </soap:Body>
</soap:Envelope>


';
$array = xml2array($array);
echo "<pre>"; print_r($array); 
function xml2array($contents, $get_attributes=1)
		{
			
				
				/**
				* xml2array() will convert the given XML text to an array in the XML structure.
				* Link: http://www.bin-co.com/php/scripts/xml2array/
				* Arguments : $contents - The XML text
				* $get_attributes - 1 or 0. If this is 1 the function will get the attributes as well as the tag values - this results in a different 							array structure in the return value.
				* Return: The parsed XML in an array form.
				*/
				if(!$contents) return array();
				
				if(!function_exists('xml_parser_create')) 
				{
				//print "'xml_parser_create()' function not found!";
				return array();
				}
				//Get the XML parser of PHP - PHP must have this module for the parser to work
				$parser = xml_parser_create();
				xml_parser_set_option( $parser, XML_OPTION_CASE_FOLDING, 0 );
				xml_parser_set_option( $parser, XML_OPTION_SKIP_WHITE, 1 );
				xml_parse_into_struct( $parser, $contents, $xml_values );
				xml_parser_free( $parser );
				
				if(!$xml_values) return;//Hmm...
				
				// Initializations
				$xml_array = array();
				$parents = array();
				$opened_tags = array();
				$arr = array();
				
				$current = &$xml_array;
				
				//Go through the tags.
				foreach($xml_values as $data) {
				unset($attributes,$value);//Remove existing values, or there will be trouble
				
				//This command will extract these variables into the foreach scope
				// tag(string), type(string), level(int), attributes(array).
				extract($data);//We could use the array by itself, but this cooler.
				
				$result = '';
				if($get_attributes) {//The second argument of the function decides this.
				$result = array();
				if(isset($value)) $result['value'] = $value;
				
				// Set the attributes too.
				if(isset($attributes)) {
				foreach($attributes as $attr => $val) {
				if($get_attributes == 1) $result['attr'][$attr] = $val; // Set all the attributes in a array called 'attr'
				/** : TODO: should we change the key name to '_attr'? Someone may use the tagname 'attr'. Same goes for 'value' too */
				}
				}
				} elseif(isset($value)) {
				$result = $value;
				}
				
				// See tag status and do the needed.
				if($type == "open") { // The starting of the tag "
				$parent[$level-1] = &$current;
				
				if(!is_array($current) or (!in_array($tag, array_keys($current)))) { // Insert New tag
				$current[$tag] = $result;
				$current = &$current[$tag];
				
				} else { // There was another element with the same tag name
				if(isset($current[$tag][0])) {
				array_push($current[$tag], $result);
				} else {
				$current[$tag] = array($current[$tag],$result);
				}
				$last = count($current[$tag]) - 1;
				$current = &$current[$tag][$last];
				}
				
				} elseif($type == "complete") { // Tags that ends in 1 line "
				// See if the key is already taken.
				if(!isset($current[$tag])) { // New Key
				$current[$tag] = $result;
				
				} else { // If taken, put all things inside a list(array)
				if((is_array($current[$tag]) and $get_attributes == 0)//If it is already an array\85
				or (isset($current[$tag][0]) and is_array($current[$tag][0]) and $get_attributes == 1)) {
				array_push($current[$tag],$result); // \85push the new element into that array.
				} else { //If it is not an array\85
				$current[$tag] = array($current[$tag],$result); //\85Make it an array using using the existing value and the new value
				}
				}
				
				} elseif($type == 'close') { //End of tag "
				$current = &$parent[$level-1];
				}
				}
				//print_r( $xml_array);
				return($xml_array);
		
			
		}
		//echo "<pre>"; print_r($array);
		if(isset($array['soap:Envelope']['attr']))
				{
					 if($array['soap:Envelope']['soap:Body'])
					 {
						$xmlns = $array['soap:Envelope']['soap:Body'];
						if(isset($xmlns['PrepareBookFlightsResponse']))
						{
							$PrepareBookFlightsResponse = $xmlns['PrepareBookFlightsResponse'];
							
							$SoapMessage = $PrepareBookFlightsResponse['SoapMessage'];
							//echo "<pre>"; print_r($SoapMessage);  
							if($SoapMessage['ErrorCode']['value'] != '0')
							{
								$ErrorMessage = $SoapMessage['ErrorMessage']['value'];
							}
							else
							{
								$response = $SoapMessage['Response']; 
								
								$FlightDetails = $response['FlightDetails'];
								//echo "<pre>"; print_r($FlightDetails);	
								$TotalFare = $FlightDetails['TotalFare'];
							}
						}
					 }
				}
		
?>