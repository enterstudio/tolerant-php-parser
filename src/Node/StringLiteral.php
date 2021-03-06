<?php
/*---------------------------------------------------------------------------------------------
 * Copyright (c) Microsoft Corporation. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *--------------------------------------------------------------------------------------------*/

namespace Microsoft\PhpParser\Node;

use Microsoft\PhpParser\Node;
use Microsoft\PhpParser\Token;

class StringLiteral extends Expression {
    /** @var Token */
    public $startQuote;

    /** @var Token[] | Node[] */
    public $children;

    /** @var Token */
    public $endQuote;

    public function getStringContentsText() {
        // TODO add tests
        $stringContents = "";
        if (isset($this->startQuote)) {
            foreach ($this->children as $child) {
                $stringContents .= $child->getFullText($this->getFileContents());
            }
        } else {
            // TODO ensure string consistency (all strings should have start / end quote)
            $stringContents = trim($this->children->getText($this->getFileContents()), '"\'');
        }
        return $stringContents;
    }
}
