<?php
/**
 * @var array<string, array{timestamp: string, count: int, name: string, weekday: int, events: array<int, array<string, mixed>>, is_sunday: bool}> $days
 * @var string $title
 */
?>
<style>
	@page {
		margin-top: 3cm;
	}

	body {
		font-family: ctxpdf;
	}

	table {
		border-collapse: collapse;
		width: 100%;
	}

	.datenumber {
		width: 1px;
		color: #555;
		text-align: right;
		white-space: nowrap;
	}

	.border {
		border-bottom: 1px solid #bbb;
	}

	.padding {
		padding: 3px;
	}

	.collapse {
		width: 1px;
		white-space: nowrap;
	}

	.event {
		width: 100%;
	}

	.right {
		text-align: right;
	}

	td {
		vertical-align: top;
	}

	.bold {
		font-weight: bold;
	}

	.day-7 {
		background: #ddd;
	}

	.logo {
		position: absolute;
		left: 50px;
		top: 40px;
	}

	.main {
		margin-top: 20px;
	}

	.heading {
		position: absolute;
		right: 50px;
		top: 40px;
		float: left;
	}

	.claim {
		position: absolute;
		left: 120px;
		top: 40px;
		font-weight: normal;
	}
</style>

<div class="logo">
	<svg width="50" height="50" viewBox="0 0 112 111" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
		<g transform="matrix(1,0,0,1,0,-64.3825)">
			<path d="M39.392,101.98L0.237,108.249C4.608,88.672 19.197,72.96 38.115,66.991L39.392,101.98Z" style="fill:rgb(0,99,221);fill-rule:nonzero;"/>
		</g>
		<g transform="matrix(1,0,0,1,0,-76.0125)">
			<path d="M103.312,103.383L56.619,110.857L50.629,76.188C52.093,76.074 53.568,76.013 55.063,76.013C75.558,76.013 93.497,86.991 103.312,103.383" style="fill:rgb(0,99,221);fill-rule:nonzero;"/>
		</g>
		<g transform="matrix(1,0,0,1,0,55.7734)">
			<path d="M42.084,55.084C20.898,50.084 4.35,33.082 0,11.64L40.063,0L42.084,55.084Z" style="fill:rgb(161,202,0);fill-rule:nonzero;"/>
		</g>
		<g transform="matrix(1,0,0,1,0,35.7425)">
			<path d="M111.25,20.443C111.25,46.413 93.631,68.28 69.682,74.702L59.27,14.453L107.57,0.413C109.951,6.639 111.25,13.392 111.25,20.443" style="fill:rgb(161,202,0);fill-rule:nonzero;"/>
		</g>
	</svg>
</div>

<h3 class="heading"><?php echo esc_html($title); ?></h3>
<h3 class="claim">GEMEINDE <strong>UNTERWEGS</strong></h3>

<table cellspacing="0" cellpadding="0" class="main">
	<tbody>
		<?php foreach ($days as $day) : ?>
			<tr class="day day-<?php echo esc_attr((string) $day['weekday']); ?>">
				<td class="padding border collapse right"><?php echo esc_html((string) $day['count']); ?></td>
				<td class="padding border collapse"><?php echo esc_html((string) $day['name']); ?></td>
				<td class="padding border">
					<?php foreach ($day['events'] as $event) : ?>
						<table cellspacing="0" cellpadding="0" class="event">
							<tr>
								<td class="event__title">
									<?php echo esc_html((string) $event['title']); ?>
									<?php if (is_string($event['person'] ?? null) && $event['person'] !== '') : ?>
										<?php echo esc_html(' (' . $event['person'] . ')'); ?>
									<?php endif; ?>
								</td>
								<td class="collapse"><?php echo esc_html(is_string($event['timeLabel'] ?? null) ? $event['timeLabel'] : ''); ?></td>
							</tr>
						</table>
					<?php endforeach; ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
