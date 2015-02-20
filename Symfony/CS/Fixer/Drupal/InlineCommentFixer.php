<?php

/*
 * This file is part of the PHP CS utility.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Symfony\CS\Fixer\Drupal;

use Symfony\CS\AbstractFixer;
use Symfony\CS\DocBlock\Line;
use Symfony\CS\Tokenizer\Tokens;

/**
 * @author Graham Campbell <graham@mineuk.com>
 */
class InlineCommentFixer extends AbstractFixer
{
    /**
     * {@inheritdoc}
     */
    public function fix(\SplFileInfo $file, $content)
    {
        $tokens = Tokens::fromCode($content);

        foreach ($tokens->findGivenKind(T_COMMENT) as $index => $token) {
            $content = $token->getContent();

            $commentCloser   = $content[(strlen(trim($content)) - 1)];
            $acceptedClosers = array(
              'full-stops'        => '.',
              'exclamation marks' => '!',
              'or question marks' => '?',
            );

            // Empty space before comment text.
            if (substr($content, 2, 1) !== ' ' && strlen($content) > 3) {
                $content = '// ' . substr($content, 2);
            }

//            // full-stop.
//            if (in_array($commentCloser, $acceptedClosers) === false) {
//                // $content = rtrim($content) . ".\n";
//            }
//
//            // First letter capital.
//            $commentText = substr($content, 3);
//            if (preg_match('/\p{Lu}|\P{L}/u', $commentText[0]) === 0) {
//                $content = '// ' . ucfirst($commentText);
//            }
            $token->setContent($content);

        }
        return $tokens->generateCode();
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return 'Inline comments must end in full-stops, exclamation marks, or question marks.';
    }

}
