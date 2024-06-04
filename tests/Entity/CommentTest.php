<?php

namespace App\Tests\Entity;

use App\Entity\Comment;
use PHPUnit\Framework\TestCase;

class CommentTest extends TestCase
{
    public function testGetPseudo()
    {
        // we create an instance of Comment
        $comment = new Comment();

        // we assign a pseudo to this instance
        $comment->setPseudo('Arcadia_99');

        // We check that the method returns the correct value
        $this->assertEquals('Arcadia_99', $comment->getPseudo());
    }
    public function testGetCommentText()
    {
        // we create an instance of Comment
        $comment = new Comment();

        // we assign a string to this instance
        $comment->setCommentText('Lorem ipsum');

        // We check that the method returns the correct value
        $this->assertEquals('Lorem ipsum', $comment->getCommentText());
    }
}
