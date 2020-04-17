import static org.junit.Assert.assertEquals;
import org.junit.*;

public class ExampleUnitTest {
	@Test
	public void exampleTrueTest() {
		assertEquals(true, Example.exampleTrue());
	}
	@Test
	public void exampleFalseTest() {
		assertEquals(false, Example.exampleFalse());
	}
}