<?php
    require_once 'configs/routes.class.php';
    require_once Chemins::LIBS . 'vendor/autoload.php';
    // require_once Chemins::LIBS_QUERY_MC .  'src/MinecraftQuery.php';
	// require_once Chemins::LIBS_QUERY_MC .  'src/MinecraftQueryException.php';
    // require_once Chemins::LIBS_QUERY_MC .  'src/MinecraftPing.php';
	// require_once Chemins::LIBS_QUERY_MC .  'src/MinecraftPingException.php';
	
	// use xPaw\MinecraftQuery;
	// use xPaw\MinecraftQueryException;
	
	// $Query = new MinecraftQuery( );
	
	// try
	// {
	// 	$Query->Connect( '172.20.0.5', 25565 );
		
	// 	print_r( $Query->GetInfo( ) );
	// 	// print_r( $Query->GetPlayers( ) );
	// }
	// catch( MinecraftQueryException $e )
	// {
	// 	echo $e->getMessage( );
	// }

	use xPaw\SourceQuery\SourceQuery;
	
	// For the sake of this example
	header( 'Content-Type: text/plain' );
	header( 'X-Content-Type-Options: nosniff' );
	
	// Edit this ->
	define( 'SQ_SERVER_ADDR', '172.20.0.5' );
	define( 'SQ_SERVER_PORT', 25575 );
	define( 'SQ_TIMEOUT',     1 );
	define( 'SQ_ENGINE',      SourceQuery::SOURCE );
	// Edit this <-
	
	$Query = new SourceQuery( );
	
	try
	{
		$Query->Connect( SQ_SERVER_ADDR, SQ_SERVER_PORT, SQ_TIMEOUT, SQ_ENGINE );
		
		$Query->SetRconPassword( $PasswordRcon );
		
		var_dump( $Query->Rcon( $CommandeRcon ) );
	}
	catch( Exception $e )
	{
		echo $e->getMessage( );
	}
	finally
	{
		$Query->Disconnect( );
	}
    
?>


