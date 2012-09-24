<?php
/**
 * BootstrapPaginator Helper class file.
 *
 * Generates pagination links
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Helper
 * @since         CakePHP(tm) v 1.2.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('PaginatorHelper', 'View/Helper');

class BootstrapPaginatorHelper extends PaginatorHelper {

/**
 * Generates a "previous" link for a set of paged records
 *
 * ### Options:
 *
 * - `tag` The tag wrapping tag you want to use, defaults to 'li'
 * - `escape` Whether you want the contents html entity encoded, defaults to true
 * - `model` The model to use, defaults to PaginatorHelper::defaultModel()
 *
 * @param string $title Title for the link. Defaults to '<< Previous'.
 * @param array $options Options for pagination link. See #options for list of keys.
 * @param string $disabledTitle Title when the link is disabled.
 * @param array $disabledOptions Options for the disabled pagination link. See #options for list of keys.
 * @return string A "previous" link or $disabledTitle text if the link is disabled.
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/paginator.html#PaginatorHelper::prev
 */
	public function prev($title = '<< Previous', $options = array(), $disabledTitle = null, $disabledOptions = array('class' => 'disabled')) {
		$defaults = array(
			'rel' => 'prev'
		);
		$options = array_merge($defaults, (array)$options);
		return $this->_pagingLink('Prev', $title, $options, $disabledTitle, $disabledOptions);
	}

/**
 * Generates a "next" link for a set of paged records
 *
 * ### Options:
 *
 * - `tag` The tag wrapping tag you want to use, defaults to 'li'
 * - `escape` Whether you want the contents html entity encoded, defaults to true
 * - `model` The model to use, defaults to PaginatorHelper::defaultModel()
 *
 * @param string $title Title for the link. Defaults to 'Next >>'.
 * @param mixed $options Options for pagination link. See above for list of keys.
 * @param string $disabledTitle Title when the link is disabled.
 * @param mixed $disabledOptions Options for the disabled pagination link. See above for list of keys.
 * @return string A "next" link or or $disabledTitle text if the link is disabled.
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/paginator.html#PaginatorHelper::next
 */
	public function next($title = 'Next >>', $options = array(), $disabledTitle = null, $disabledOptions = array('class' => 'disabled')) {
		$defaults = array(
			'rel' => 'next'
		);
		$options = array_merge($defaults, (array)$options);
		return $this->_pagingLink('Next', $title, $options, $disabledTitle, $disabledOptions);
	}

/**
 * Returns a set of numbers for the paged result set
 * uses a modulus to decide how many numbers to show on each side of the current page (default: 8).
 *
 * `$this->Paginator->numbers(array('first' => 2, 'last' => 2));`
 *
 * Using the first and last options you can create links to the beginning and end of the page set.
 *
 * ### Options
 *
 * - `before` Content to be inserted before the numbers
 * - `after` Content to be inserted after the numbers
 * - `model` Model to create numbers for, defaults to PaginatorHelper::defaultModel()
 * - `modulus` how many numbers to include on either side of the current page, defaults to 8.
 * - `separator` Separator content defaults to null
 * - `tag` The tag to wrap links in, defaults to 'li'
 * - `first` Whether you want first links generated, set to an integer to define the number of 'first'
 *    links to generate.
 * - `last` Whether you want last links generated, set to an integer to define the number of 'last'
 *    links to generate.
 * - `ellipsis` Ellipsis content, defaults to '...'
 * - `class` Class for wrapper tag
 * - `currentClass` Class for wrapper tag on current active page, defaults to 'current'
 *
 * @param mixed $options Options for the numbers, (before, after, model, modulus, separator)
 * @return string numbers string.
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/paginator.html#PaginatorHelper::numbers
 */
	public function numbers($options = array()) {
		if ($options === true) {
			$options = array(
				'before' => null, 'after' => null, 'first' => 'first', 'last' => 'last'
			);
		}

		$defaults = array(
			'tag' => 'li', 'before' => null, 'after' => null, 'model' => $this->defaultModel(), 'class' => null,
			'modulus' => '8', 'separator' => null, 'first' => null, 'last' => null, 'ellipsis' => '...', 'currentClass' => 'active'
		);
		$options += $defaults;

		$params = (array)$this->params($options['model']) + array('page' => 1);
		unset($options['model']);

		if ($params['pageCount'] <= 1) {
			return false;
		}

		extract($options);
		unset($options['tag'], $options['before'], $options['after'], $options['model'],
			$options['modulus'], $options['separator'], $options['first'], $options['last'],
			$options['ellipsis'], $options['class'], $options['currentClass']
		);

		$out = '';

		if ($modulus && $params['pageCount'] > $modulus) {
			$half = intval($modulus / 2);
			$end = $params['page'] + $half;

			if ($end > $params['pageCount']) {
				$end = $params['pageCount'];
			}
			$start = $params['page'] - ($modulus - ($end - $params['page']));
			if ($start <= 1) {
				$start = 1;
				$end = $params['page'] + ($modulus - $params['page']) + 1;
			}

			if ($first && $start > 1) {
				$offset = ($start <= (int)$first) ? $start - 1 : $first;
				if ($offset < $start - 1) {
					$out .= $this->first($offset, compact('tag', 'separator', 'ellipsis', 'class'));
				} else {
					$out .= $this->first($offset, compact('tag', 'separator', 'class') + array('after' => $separator));
				}
			}

			$out .= $before;

			for ($i = $start; $i < $params['page']; $i++) {
				$out .= $this->Html->tag($tag, $this->link($i, array('page' => $i), $options), compact('class')) . $separator;
			}

			if ($class) {
				$currentClass .= ' ' . $class;
			}
			$out .= $this->Html->tag($tag, $params['page'], array('class' => $currentClass));
			if ($i != $params['pageCount']) {
				$out .= $separator;
			}

			$start = $params['page'] + 1;
			for ($i = $start; $i < $end; $i++) {
				$out .= $this->Html->tag($tag, $this->link($i, array('page' => $i), $options), compact('class')) . $separator;
			}

			if ($end != $params['page']) {
				$out .= $this->Html->tag($tag, $this->link($i, array('page' => $end), $options), compact('class'));
			}

			$out .= $after;

			if ($last && $end < $params['pageCount']) {
				$offset = ($params['pageCount'] < $end + (int)$last) ? $params['pageCount'] - $end : $last;
				if ($offset <= $last && $params['pageCount'] - $end > $offset) {
					$out .= $this->last($offset, compact('tag', 'separator', 'ellipsis', 'class'));
				} else {
					$out .= $this->last($offset, compact('tag', 'separator', 'class') + array('before' => $separator));
				}
			}

		} else {
			$out .= $before;

			for ($i = 1; $i <= $params['pageCount']; $i++) {
				if ($i == $params['page']) {
					if ($class) {
						$currentClass .= ' ' . $class;
					}
					$out .= $this->Html->tag($tag, $this->link($params['page'], '#', $options), array('class' => $currentClass));
				} else {
					$out .= $this->Html->tag($tag, $this->link($i, array('page' => $i), $options), compact('class'));
				}
				if ($i != $params['pageCount']) {
					$out .= $separator;
				}
			}

			$out .= $after;
		}

		return $out;
	}

/**
 * Returns a first or set of numbers for the first pages.
 *
 * `echo $this->Paginator->first('< first');`
 *
 * Creates a single link for the first page.  Will output nothing if you are on the first page.
 *
 * `echo $this->Paginator->first(3);`
 *
 * Will create links for the first 3 pages, once you get to the third or greater page. Prior to that
 * nothing will be output.
 *
 * ### Options:
 *
 * - `tag` The tag wrapping tag you want to use, defaults to 'li'
 * - `after` Content to insert after the link/tag
 * - `model` The model to use defaults to PaginatorHelper::defaultModel()
 * - `separator` Content between the generated links, defaults to null
 * - `ellipsis` Content for ellipsis, defaults to '...'
 *
 * @param mixed $first if string use as label for the link. If numeric, the number of page links
 *   you want at the beginning of the range.
 * @param mixed $options An array of options.
 * @return string numbers string.
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/paginator.html#PaginatorHelper::first
 */
	public function first($first = '<< first', $options = array()) {
		$options = array_merge(
			array(
				'tag' => 'li',
				'after' => null,
				'model' => $this->defaultModel(),
				'separator' => null,
				'ellipsis' => '...',
				'class' => null
			),
		(array)$options);

		$params = array_merge(array('page' => 1), (array)$this->params($options['model']));
		unset($options['model']);

		if ($params['pageCount'] <= 1) {
			return false;
		}
		extract($options);
		unset($options['tag'], $options['after'], $options['model'], $options['separator'], $options['ellipsis'], $options['class']);

		$out = '';

		if (is_int($first) && $params['page'] >= $first) {
			if ($after === null) {
				$after = $ellipsis;
			}
			for ($i = 1; $i <= $first; $i++) {
				$out .= $this->Html->tag($tag, $this->link($i, array('page' => $i), $options), compact('class'));
				if ($i != $first) {
					$out .= $separator;
				}
			}
			$out .= $after;
		} elseif ($params['page'] > 1 && is_string($first)) {
			$options += array('rel' => 'first');
			$out = $this->Html->tag($tag, $this->link($first, array('page' => 1), $options), compact('class')) . $after;
		}
		return $out;
	}

/**
 * Returns a last or set of numbers for the last pages.
 *
 * `echo $this->Paginator->last('last >');`
 *
 * Creates a single link for the last page.  Will output nothing if you are on the last page.
 *
 * `echo $this->Paginator->last(3);`
 *
 * Will create links for the last 3 pages.  Once you enter the page range, no output will be created.
 *
 * ### Options:
 *
 * - `tag` The tag wrapping tag you want to use, defaults to 'li'
 * - `before` Content to insert before the link/tag
 * - `model` The model to use defaults to PaginatorHelper::defaultModel()
 * - `separator` Content between the generated links, defaults to null
 * - `ellipsis` Content for ellipsis, defaults to '...'
 *
 * @param mixed $last if string use as label for the link, if numeric print page numbers
 * @param mixed $options Array of options
 * @return string numbers string.
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/paginator.html#PaginatorHelper::last
 */
	public function last($last = 'last >>', $options = array()) {
		$options = array_merge(
			array(
				'tag' => 'li',
				'before' => null,
				'model' => $this->defaultModel(),
				'separator' => null,
				'ellipsis' => '...',
				'class' => null
			),
		(array)$options);

		$params = array_merge(array('page' => 1), (array)$this->params($options['model']));
		unset($options['model']);

		if ($params['pageCount'] <= 1) {
			return false;
		}

		extract($options);
		unset($options['tag'], $options['before'], $options['model'], $options['separator'], $options['ellipsis'], $options['class']);

		$out = '';
		$lower = $params['pageCount'] - $last + 1;

		if (is_int($last) && $params['page'] <= $lower) {
			if ($before === null) {
				$before = $ellipsis;
			}
			for ($i = $lower; $i <= $params['pageCount']; $i++) {
				$out .= $this->Html->tag($tag, $this->link($i, array('page' => $i), $options), compact('class'));
				if ($i != $params['pageCount']) {
					$out .= $separator;
				}
			}
			$out = $before . $out;
		} elseif ($params['page'] < $params['pageCount'] && is_string($last)) {
			$options += array('rel' => 'last');
			$out = $before . $this->Html->tag(
				$tag, $this->link($last, array('page' => $params['pageCount']), $options), compact('class')
			);
		}
		return $out;
	}

/**
 * Protected method for generating prev/next links
 *
 * @param string $which
 * @param string $title
 * @param array $options
 * @param string $disabledTitle
 * @param array $disabledOptions
 * @return string
 */
	protected function _pagingLink($which, $title = null, $options = array(), $disabledTitle = null, $disabledOptions = array()) {
		$check = 'has' . $which;
		$_defaults = array(
			'url' => array(), 'step' => 1, 'escape' => false,
			'model' => null, 'tag' => 'li', 'class' => strtolower($which)
		);
		$options = array_merge($_defaults, (array)$options);
		$paging = $this->params($options['model']);
		if (empty($disabledOptions)) {
			$disabledOptions = $options;
		}

		if (!$this->{$check}($options['model']) && (!empty($disabledTitle) || !empty($disabledOptions))) {
			if (!empty($disabledTitle) && $disabledTitle !== true) {
				$title = $disabledTitle;
			}
			$options = array_merge($_defaults, (array)$disabledOptions);
		} elseif (!$this->{$check}($options['model'])) {
			return null;
		}

		foreach (array_keys($_defaults) as $key) {
			${$key} = $options[$key];
			unset($options[$key]);
		}
		$url = array_merge(array('page' => $paging['page'] + ($which == 'Prev' ? $step * -1 : $step)), $url);

		if ($this->{$check}($model)) {
			return $this->Html->tag($tag, $this->link($title, $url, array_merge($options, compact('escape'))), compact('class'));
		} else {
			unset($options['rel']);
			return $this->Html->tag($tag, $this->link($title, '#', array_merge($options, compact('escape'))), array_merge($options, compact('escape', 'class')));
		}
	}

}
