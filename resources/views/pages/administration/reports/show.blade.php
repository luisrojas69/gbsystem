<?php
switch ($accion) {
	
	case 'general':
	?>

	@json($result)

	<?php
	break;
	
	case 'by_planks':
	?>

	@json($result)

	<?php
	break;	
	
	case 'pluviometry':
	?>

	@json($result)

	<?php
	break;
	
	default:
		# code...
		break;
}
?>


